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



	public static void main(String[] args) {

       // String filePath = "C:\\Users\\Patrik\\Desktop\\file.xml";
        String filePath = "/home/christoffergunning/workspace/evengers/file.xml";

		XMLHelper xmlHelper = new XMLHelper();

		ArrayList<String> links = parseDocument(xmlHelper, "https://en.wikipedia.org/wiki/F.C.Barcelona");

		int i = 0;

		for(String newWebsite : links){

			if(xmlHelper.numberOfDocs > 100)
				break;

			parseDocument(xmlHelper, newWebsite);
			i++;
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

	public static ArrayList<String> parseDocument(XMLHelper xmlHelper, String websiteUrl){

		try {

			Document doc = Jsoup.connect(websiteUrl).get();

			String title = doc.select("h1#firstHeading").text();

			//			System.out.println("Title: " + title);

			Elements imageContainers = doc.select("div.thumbinner");

			for(Element element : imageContainers){

				String image_descr = element.select("div.thumbcaption").text();
				String image_link = element.select("img.thumbimage").attr("src"); 

				if(image_descr == "" || image_link == "")
					continue;

				//				System.out.println("Descr: " + image_descr);

				//				System.out.println("Link: " + image_link);

				xmlHelper.addDoc(title, image_link, image_descr);
			}

			ArrayList<String> links = new ArrayList<String>();

			Elements linkElements = doc.select("a");

			String temp = "";

			String tempLink = "";

			for(Element linkElement : linkElements){

				temp = linkElement.attr("href");

				if(temp.startsWith("/wiki/")){

					tempLink = "https://en.wikipedia.org" + temp;

					if(!links.contains(tempLink)){

						links.add(tempLink);

						//						System.out.println(tempLink);
					}
				}
			}

			return links;

		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		return null;
	}

}
