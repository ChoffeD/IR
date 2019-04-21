import java.io.File;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class Merge {

	public static final String sep = ";";

	public static final Map<String, Integer> Factor2Int = new HashMap<>() {{
		put("0.5", 0);
		put("0.6", 1);
		put("0.7", 2);
		put("0.8", 3);
		put("0.9", 4);
		put("1.0", 5);
		put("1.1", 6);
		put("1.2", 7);
		put("1.3", 8);
		put("1.4", 9);
		put("1.5", 10);
		put("1.6", 11);
		put("1.7", 12);
		put("1.8", 13);
	}};

	public static final Map<Integer, String> Int2Factor = new HashMap<>() {{
		put(0,"0.5");
		put(1,"0.6");
		put(2, "0.7");
		put(3, "0.8");
		put(4, "0.9");
		put(5, "1.0");
		put(6, "1.1");
		put(7, "1.2");
		put(8, "1.3");
		put(9, "1.4");
		put(10, "1.5");
		put(11, "1.6");
		put(12, "1.7");
		put(13, "1.8");
	}};

	public static final Map<Integer, String> Int2Pitch = new HashMap<>() {{
		put(0,"-3");
		put(1,"-2");
		put(2, "-1");
		put(3, "0");
		put(4, "1");
		put(5, "2");
		put(6, "3");
	}};

	public static final Map< String, Integer> Pitch2Int = new HashMap<>() {{
		put("-3", 0);
		put("-2", 1);
		put("-1", 2);
		put("0", 3);
		put("1", 4);
		put("2", 5);
		put("3", 6);
	}};

	public static void merge_csv(String directoryPath) {
		File directory = new File(directoryPath);       
		File[] files = directory.listFiles();
		float[][][] contenue = new float[10][14][7];
		float[][][][] contenueFinal = new float[10][14][7][files.length];
		int nbFile = 0;
		for (File file : files) {	
			System.out.println(file.getName());
			contenue = getTabFromCsv(file);
			for (int i = 0; i < contenueFinal.length; i++) {
				for (int j = 0; j < contenueFinal[0].length; j++) {
					for (int k = 0; k < contenueFinal[0][0].length; k++) {
						if(contenue[i][j][k]!=0)
							contenueFinal[i][j][k][nbFile] = contenue[i][j][k]; 
					}
				}
			}
			nbFile++;
		}
		contenueFinal = addMoyenne(contenueFinal);
		writeCsv(contenueFinal, directoryPath+"\\data_final.csv");

	}

	public static float[][][][] addMoyenne(float[][][][] data){
		float[][][][] dataModifie = new float[data.length][data[0].length][data[0][0].length][data[0][0][0].length+1];
		int p;
		float q;
		float tot;
		int length= data[0][0][0].length;
		for (int i = 0; i < data.length; i++) {
			for (int j = 0; j < data[0].length; j++) {
				for (int k = 0; k < data[0][0].length; k++) {
					p=0; tot = 0;
					for (int l = 0; l < length; l++) {
						q = data[i][j][k][l];
						dataModifie[i][j][k][l] = q;
						if(q != 0) {
							tot +=q;
							p++;
						}
					}
					if(p != 0)
						dataModifie[i][j][k][length] = tot/p;
					else 
						dataModifie[i][j][k][length] = 0;
				}
			}
		}


		return dataModifie;
	}

	public static void writeCsv(float[][][][] data, String filename) {
		try{
			System.out.println(filename);
			File test1 = new File(filename);
			PrintWriter writer = new PrintWriter(test1);
			String ligne;
			ligne = "File"+sep+"Factor"+sep+"Pitch";
			for (int i = 0; i < data[0][0][0].length-1; i++) {
				ligne+=sep+"Testeur"+i;
			}
			ligne+=sep+"Moyenne";
			writer.print(ligne);
			writer.print("\n");
			for (int i = 0; i < data.length; i++) {
				ligne = "";
				for (int j = 0; j < data[i].length; j++) {
					for (int j2 = 0; j2 < data[i][j].length; j2++) {
						ligne =(i+1)+sep+Int2Factor.get(j)+sep+Int2Pitch.get(j2);
						for (int k = 0; k < data[i][j][j2].length; k++) {
							if(data[i][j][j2][k] != 0)
								ligne+= sep+data[i][j][j2][k];
							else 
								ligne+=sep;
						}
						writer.print(ligne);
						writer.print("\n");
					}
				}
			}
			writer.close();
		} catch(Exception e) {
			e.printStackTrace(System.err) ;
		}
	}


	public static void main(String[] args) {		
		String path = "..\\..\\..\\..\\UwAmp\\www\\IR\\IR\\Data";
		merge_csv(path);
	}

	public static float[][][] getTabFromCsv(File file) {
		float[][][] contenue = new float[10][14][7];
		try {
			List<String> lines = Tools.readFile(file);
			int i  = 0;
			for (String line : lines) {		
				if(i != 0) {
					String[] oneData = line.split(sep);
					contenue[Integer.valueOf(oneData[0])-1]
							[Factor2Int.get(oneData[1])]
									[Pitch2Int.get(oneData[2])] =  Float.valueOf(oneData[3]);
				}i++;
			}
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return contenue;
	}
}
