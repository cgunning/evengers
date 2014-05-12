import java.io.File;
import java.io.IOException;
import java.util.ArrayList;

import javax.xml.transform.Transformer;
import javax.xml.transform.TransformerConfigurationException;
import javax.xml.transform.TransformerException;
import javax.xml.transform.TransformerFactory;
import javax.xml.transform.dom.DOMSource;
import javax.xml.transform.stream.StreamResult;

import HTMLParser.XMLHelper;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import org.jsoup.select.Elements;



public class Main {


    static ArrayList<String> visitedLinks = new ArrayList<String>();

	public static void main(String[] args) {

       // String filePath = "C:\\Users\\Patrik\\Desktop\\file.xml";
        String filePath = "/home/christoffergunning/workspace/evengers/file1000.xml";

		XMLHelper xmlHelper = new XMLHelper();



		for(int i = 0; xmlHelper.numberOfDocs < 1000; i++){

			String tmp = parseDocument(xmlHelper, "http://en.wikipedia.org/wiki/Special:Random");
            if(tmp != null)
                visitedLinks.add(tmp);
		}

		System.out.println("XML:");

		TransformerFactory transformerFactory = TransformerFactory.newInstance();
		try {
			Transformer transformer = transformerFactory.newTransformer();
			DOMSource source = new DOMSource(xmlHelper.document);

			StreamResult result = new StreamResult(new File(filePath));

			// Output to console for testing
			// StreamResult result = new StreamResult(System.out);

			transformer.transform(source, result);

			System.out.println("File saved!");
			System.out.println(source.toString());

		} catch (TransformerConfigurationException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (TransformerException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

	public static String parseDocument(XMLHelper xmlHelper, String websiteUrl){

		try {

			Document doc = Jsoup.connect(websiteUrl).get();

			String title = doc.select("h1#firstHeading").text();
            if(visitedLinks.contains(title))
                return null;

			Elements imageContainers = doc.select("div.thumbinner");
            System.out.println("Parsing document: " + title);
            for(Element element : imageContainers){

				String image_descr = element.select("div.thumbcaption").text();
				String image_link = element.select("img.thumbimage").attr("src"); 

				if(image_descr == "" || image_link == "")
					continue;

				xmlHelper.addDoc(title, image_link, image_descr);
			}

            return title;

		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		return null;
	}

}
