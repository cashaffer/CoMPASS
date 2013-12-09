 =======================================================
|| Sequence of steps to build a recommendation engine: || 
 =======================================================
definitions:
a sequence is an ordered series of elements.
lcs = longest common subsequence between two sequences.
similarity score = how close are two sequences.

steps:

0) Prepare an input file.
The logdata table in our database store all information about the students' clicks.
We have to selectively filter it for our inputs. Run the following query to get the sequences of clicks for students who were learning about Inclined Planes:
-----------
SELECT idexploration,idconcept,idtopic,idunit,timelength FROM compass_mt.logdata l where idexploration in (SELECT idexploration FROM compass_mt.exploration e where question like '%lined%')
order by idexploration,time;
-------------
Now right-click on the result and save the output in CSV format with name "inclined-id_concept_topic_unit_time.csv".
Remove the first line from the file, which is the column heading.

1) Extract sessions (sequence of consecutive clicks for a student).
The above file was in the format having one line per click. We now convert it to one line per session, with the session id at the start, followed by the visited concepts, like this:
--------
sessid1:con1,con2,...conN
----------
To do this, open the file "C:\Python26\test programs\parse_csv_for_id_time.py" and specify the correct input and output filenames.
Now run it as :
---------------
C:\Python26\test programs> ..\python.exe parse_csv_for_id_time.py
--------------
It should produce "inclined-normalized_concepts.csv" and "inclined-parsed_time.csv".

2) Normalize the time values.
Convert the time spent on a page as a percent of total time spent on the session for easy processing.
---Note:--- modify the python program first to take in the correct file.
----------------
C:\Python26\test programs >..\python.exe normalize_time.py
----------------
It should create "inclined-normalized_time.csv".

3) Find similar sequences.
Run LCS.py to find similarity between each pair of sequences.
-------
C:\Python26\test programs > ..\python.exe lcs.py
-------
It should produce "inclined-graph_output.csv", which is a NxN matrix of floats. We have to specify N in the first line.
Insert "N N" in the first line, which will be empty, where N is the number of lines in the file minus one.

4) Find clusters.
Copy the earlier output file to Cluto's directory and run vcluster as :
-------------
D:\Pathfinder and k-means\cluto-2.1.2a\cluto-2.1.2\MSWIN-x86> vcluster.exe inclined-graph_output.csv 10
-------------
This should output the clusters in the file "inclined-graph_output.csv.clustering.10".

5) Find concept probabilities.
Copy the cluster file to the python directory, modify and run "read_clustered_result.py".
This should output two files: "inclined-graph_result_clusters.csv" and "inclined-pair_probabilities.csv".

6) Insert into database.
Create a new table inclined_pair_probabilities.
Copy "inclined-pair_probabilities.csv" to "Y:\Apache2\compass_mt\compass\student\hinter" and run "bulk_insert.php".

===================================
Old instructions -- ignore
===================================
1) we have the logdata in the sql database in the following format:
sequence id, element, timespent.

we convert it to the following format:
File_1 (called as "normalized_concepts") :
(subtract 90 from the concept num)
<line 1>seq id1:element1,element2,0\n
<line 2>seq id2:element4,element6,element8,0\n

File_2 (called as "normalized_time") :
<line 1>seq id1:time1,time2,0\n
<line 2>seq id2:time4,time6,time8,0\n

2) run the python program lcs.py. it reads from the files 
"D:\Pathfinder and k-means\Python\normalized_concepts.csv" and "normalized_time.csv".
and outputs to file
"graph_output.csv"
in the following format:
<line 1>3
<line 2>sim_score_1_1 sim_score_1_2 sim_score_1_3
<line 3>sim_score_2_1 sim_score_2_2 sim_score_2_3
<line 4>sim_score_3_1 sim_score_3_2 sim_score_3_3

NOTE:
older lcs programs print the output in following format:
seq_i seq_j sim_i_j 
if so, convert to the sparse graph representation using create_sparse_graph.py.
the sparse graph representation is :
<line 1>num_nodes num_edges
<line 2>node_id1 sim_score1 node_id2 sim_score2

(note that here <line 2> has values for the node with id = 1. the corresponding sequence id might be different. for eg., seq id 5 (stored in normalized_concepts) denotes node id 1.
node_id = hash[seq_id] -- typically the line number the seq_id appears in normalized_concepts.

4) run cluto on the graph representation as :
D:\Pathfinder and k-means\cluto-2.1.2a\cluto-2.1.2\MSWIN-x86>scluster.exe graph_output.csv 100
to get the output file as graph_output.csv.clustering.100, which is of the form
<line 1>cluster_id_for_node_1
<line 2>cluster_id_for_node_2

5) run read_clustered_result.py on the clustered result.
to get the file pair_probabilities.csv, which is of the form:
<line 1>(cluster_id1,element1,element2,transition_score)

it also gives an interactive command prompt for testing.


6) insert the pair probabilities into compass_mt.cluster_probabilities;




