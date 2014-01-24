/*
 * ConceptMapParser.java
 *
 * Created on October 29, 2004, 12:04 PM
 */

package com.compass.conceptmap.parser;

/**
 *
 * @author  cao2
 */

import java.io.IOException;
import java.util.Enumeration;

import javax.xml.parsers.ParserConfigurationException;
import javax.xml.parsers.SAXParser;
import javax.xml.parsers.SAXParserFactory;

import org.xml.sax.Attributes;
import org.xml.sax.SAXException;
import org.xml.sax.XMLReader;
import org.xml.sax.helpers.DefaultHandler;

public class ConceptMapParser {


    private SAXParser parser;

    public static Units units = new Units();

    private XMLReader xmlReader;

    public static Concepts concepts = new Concepts();

    private String[] datafiles;

    /** Creates a new instance of ConceptMapParser */
    public ConceptMapParser(String uri[]) throws ParserConfigurationException,SAXException{
        parser = SAXParserFactory.newInstance().newSAXParser();
        datafiles = uri;
    }


    public void parse() throws ParserConfigurationException, SAXException, IOException{
        XMLReader reader = parser.getXMLReader();
        reader.setContentHandler(new ConceptHandler());
        reader.parse(datafiles[0]);
        reader.setContentHandler(new RelationHandler());
        reader.parse(datafiles[1]);
        reader.setContentHandler(new ExampleHandler());
        reader.parse(datafiles[2]);
    }

    class ConceptHandler extends DefaultHandler {
      public void startElement(String namespaceURI, String localName, String qualifiedName, Attributes atts) throws SAXException {
        Concept concept;
        if(qualifiedName.equals("concept")){
          concept = new Concept();
          concept.setId(atts.getValue("id"));
          concept.setLabel(atts.getValue("label"));
          concepts.addConcept(concept);
        }
      }
    }

    class RelationHandler extends DefaultHandler {
      Unit unit;
      Topics topics;
      Topic topic;
      Relations relations;
      Relation relation;      
      SubUnit subUnit;
      String from,to;
      boolean insideSubUnit = false;
      public void endElement(String namespaceURI, String localName, String qualifiedName) {
    	  if (qualifiedName.equals("sub_unit")) {
    		  insideSubUnit = false;
    	  }
      }   	  
      
      public void startElement(String namespaceURI, String localName, String qualifiedName, Attributes atts) throws SAXException {
        if(qualifiedName.equals("unit")){
          unit = new Unit();
          topics = new Topics();
          unit.setTopics(topics);
          unit.setId(atts.getValue("id"));
          unit.setLabel(atts.getValue("label"));
          units.addUnit(unit);
        }
        if (qualifiedName.equals("sub_unit")) {
        	subUnit = new SubUnit(atts.getValue("id"), atts.getValue("label"));
        	unit.addSubUnit(subUnit);
        	insideSubUnit = true;
        }
        if(qualifiedName.equals("topic")){
          topic = new Topic();
          relations = new Relations();
          topic.setRelations(relations);
          topic.setId(atts.getValue("id"));
          topic.setUnit(unit);
          topic.setLabel(atts.getValue("label"));
          topics.addTopic(topic);
          
          if (insideSubUnit) {
        	  subUnit.addTopic(topic);
          }
        }
        if(qualifiedName.equals("edge")){
          relation = new Relation();
          from = atts.getValue("source");
          to = atts.getValue("target");
          relation.setSource(from);
          relation.setTarget(to);
          relation.setLabel(atts.getValue("label"));
          relation.setComments(atts.getValue("description"));
          concepts.getConcept(from).addTopic(topic.getId(),unit.getId());
          concepts.getConcept(to).addTopic(topic.getId(),unit.getId());
          relations.addRelation(relation);
        }
      }
    }


    class ExampleHandler extends DefaultHandler {
      String id = null ,label = null;
      public void startElement(String namespaceURI, String localName, String qualifiedName, Attributes atts) throws SAXException {
        if(qualifiedName.equals("example")){
          id = atts.getValue("id");
          label = atts.getValue("label");
        }
        if(qualifiedName.equals("concept")){
          if(id != null && label != null)
            concepts.getConcept(atts.getValue("id")).addExample(id,label);
        }
      }
    }
    
 public static void main(String argv[]){
        try{
          String[] df = {
        		  "D:\\CompasS\\com\\compass\\conceptmap\\concepts.xml",
        		  "D:\\CompasS\\com\\compass\\conceptmap\\relation15.xml",
        		  "D:\\CompasS\\com\\compass\\conceptmap\\examples.xml"};
            ConceptMapParser cmp = new ConceptMapParser(df);
            cmp.parse();
            Enumeration cpts = concepts.getAllConcepts();
            while(cpts.hasMoreElements()){
              String cptid= (String) cpts.nextElement();
              Concept c = concepts.getConcept(cptid);
              System.out.println("Concept label: " + c.getLabel());
              Enumeration e = c.getExamples().keys();
              while(e.hasMoreElements()){
                System.out.println("---example:"+c.getExamples().get(e.nextElement()));
              }
            }
            Enumeration allunits = units.getUnitIds();
            Unit c;
            while(allunits.hasMoreElements()){
                c=(Unit) units.getUnit((String) allunits.nextElement());
                System.out.println(c.getId()+":"+c.getLabel());
                Topics ts = c.getTopics();
                Enumeration alltopics = ts.getTopicIds();
                while(alltopics.hasMoreElements()){
                   Topic t=(Topic) ts.getTopic((String) alltopics.nextElement());
                   System.out.println("---"+t.getId()+":"+t.getLabel());
                   Relations rs = t.getRelations();
                   for(int i=0;i<rs.size();i++){
                     System.out.println("------from:"+rs.get(i).getSource()+", to:"+rs.get(i).getTarget());
                   }
               }

            }
        }catch (Exception e){
            System.out.println(e.toString());
        }
    }

}
