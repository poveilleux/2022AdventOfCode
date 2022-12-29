import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;

public class MyClass {
  public static void main(String args[]) 
      throws IOException
  {
    BufferedReader reader = new BufferedReader(new InputStreamReader(System.in));

    String line = reader.readLine();
    int sum = 0;
    int max = 0;
    while (line != null) {
        try {
          int x = Integer.parseInt(line);
          sum = sum + x;
        } catch (NumberFormatException ex) {
          if (sum > max) {
              max = sum;
          }
          sum = 0;
        }
      
        line = reader.readLine();
    }
    
    System.out.println(max);
  }
}
