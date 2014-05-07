How to Start:
navigate to:
.../evengers/solr/example
Start with:
java -jar start.jar 

Access admin panel:
http://localhost:8983/solr/#/


http://localhost:8983/solr/newCore/update/json -H 'Content-type:application/json' -d '
[
 {"id" : "TestDoc1", "title" : "test1"},
 {"id" : "TestDoc2", "title" : "another test"}
]'

Query all (*:*):
http://localhost:8983/solr/newCore/select?q=*%3A*&wt=json

response:
{
  "responseHeader": {
    "status": 0,
    "QTime": 1,
    "params": {
      "indent": "true",
      "q": "*:*",
      "_": "1399466865206",
      "wt": "json"
    }
  },
  "response": {
    "numFound": 1,
    "start": 0,
    "docs": [
      {
        "id": "999",
        "title": "test",
        "imageurl": "test.com",
        "_version_": 1467447362417852400
      }
    ]
  }
}

Mode about query:
https://wiki.apache.org/solr/SolrQuerySyntax
http://wiki.apache.org/solr/CommonQueryParameters
http://lucene.apache.org/solr/3_6_2/doc-files/tutorial.html
