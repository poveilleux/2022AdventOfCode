import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.util.*;

public class MyClass {
  public static void main(String args[]) 
      throws IOException
  {
    BufferedReader reader = new BufferedReader(new InputStreamReader(System.in));

    String line = reader.readLine();
    int sum = 0;
    List<Integer> list = new ArrayList<Integer>();
    while (line != null) {
        try {
          int x = Integer.parseInt(line);
          sum = sum + x;
        } catch (NumberFormatException ex) {
          list.add(sum);
          sum = 0;
        }
      
        line = reader.readLine();
    }
    
    Collections.sort(list, Collections.reverseOrder());
    System.out.println(list.get(0) + list.get(1) + list.get(2));
  }
}
