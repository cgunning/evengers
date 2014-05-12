package HTMLParser;

import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;

import org.w3c.dom.Document;
import org.w3c.dom.Element;

public class XMLHelper {

	public Document document;

	Element rootElement;

	public int numberOfDocs = 1;

	public XMLHelper(){

		try {

			DocumentBuilderFactory docFactory = DocumentBuilderFactory.newInstance();
			DocumentBuilder docBuilder;
			docBuilder = docFactory.newDocumentBuilder();

			// root elements
			document = docBuilder.newDocument();
			rootElement = document.createElement("add");

			document.appendChild(rootElement);

		} catch (ParserConfigurationException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

	public void addDoc(String titleString, String urlString, String descrString){

		Element doc = document.createElement("doc");

		Element id = document.createElement("field");
        id.setAttribute("name", "id");
		id.appendChild(document.createTextNode("" + numberOfDocs));

		doc.appendChild(id);

		Element title = document.createElement("field");
        title.setAttribute("name", "title");
		title.appendChild(document.createTextNode(titleString));

		doc.appendChild(title);

		Element url = document.createElement("field");
        url.setAttribute("name", "url");
		url.appendChild(document.createTextNode(urlString));

		doc.appendChild(url);

		Element descr = document.createElement("field");
        descr.setAttribute("name", "descr");
        descr.appendChild(document.createTextNode(descrString));

		doc.appendChild(descr);

		numberOfDocs++;
		rootElement.appendChild(doc);
	}
}
