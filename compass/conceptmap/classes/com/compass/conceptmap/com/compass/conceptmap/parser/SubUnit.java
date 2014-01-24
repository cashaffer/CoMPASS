package com.compass.conceptmap.parser;

public class SubUnit {
	private String id;
	private String label;
	private Units units;
	private Topics topics;

	public SubUnit(String id, String label) {
		this.id = id;
		this.label = label;
		topics = new Topics();
	}
	
	public void setId(String id) {
		this.id = id;
	}
	public void setLabel(String label) {
		this.label = label;
	}
	public String getId() {
		return id;
	}
	public String getLabel() {
		return label;
	}	
	public void setUnits(Units units) {
		this.units = units;
	}
	public Units getUnits() {
		return units;
	}
	
	public void addTopic(Topic t) {
		topics.addTopic(t);
	}
	
	public Topics getTopics() {
		return topics;
	}
}

