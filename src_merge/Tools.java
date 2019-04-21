import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class Tools {

	public static String getResourcePath(String fileName) {
		final File f = new File("");
		final String dossierPath = f.getAbsolutePath() + File.separator + fileName;
		return dossierPath;
	}

	public static File getResource(String fileName) {
		final String completeFileName = getResourcePath(fileName);
		File file = new File(completeFileName);
		return file;
	}

	public static List<String> readFile(File file) throws IOException {

		List<String> result = new ArrayList<String>();

		FileReader fr = new FileReader(file);
		BufferedReader br = new BufferedReader(fr);

		for (String line = br.readLine(); line != null; line = br.readLine()) {
			result.add(line);
		}

		br.close();
		fr.close();

		return result;
	}

	public static void main(String[] args) {
		String path = "..\\..\\..\\..\\UwAmp\\www\\IR\\data_manu.csv";
		final File file = getResource(path);
		try {
			List<String> lines = Tools.readFile(file);
			for (String line : lines) 
				System.out.println(line);
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
}
