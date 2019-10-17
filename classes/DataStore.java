package logic;

import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import com.mysql.cj.jdbc.Driver;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 * Servlet implementation class DataStore
 */
public class DataStore extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public DataStore() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		//response.getWriter().append("Served at: ").append(request.getContextPath());
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		
		try {
			int inputMinutes = Integer.parseInt(request.getParameter("quantity"));
			int totalMinutes = 0; 
			
			System.out.println(inputMinutes);
			
			try {
				Class.forName("com.mysql.cj.jdbc.Driver");

				String dbURL = "jdbc:mysql://localhost:3306/parc-base";
				
				Connection connection = 
						DriverManager.getConnection(dbURL, "root", "bannon123");

				Statement insertStatement = connection.createStatement();
				
				insertStatement.execute("INSERT INTO `parc-base`.`Times` "
						+ "(`minutes`) "
                        + "VALUES ('" + inputMinutes + "');");
				
				Statement getTimesStatement = connection.createStatement();
	
				ResultSet resultSet = 
						getTimesStatement.executeQuery("SELECT * from Times");
				
				int numTimes = 0; 
				while (resultSet.next()) {
					totalMinutes += Integer.parseInt(resultSet.getString("minutes"));
					numTimes++;
				}
				
				
				getTimesStatement.close(); 
				resultSet.close();
				insertStatement.close();
				connection.close();			
				
				response.getWriter().append(" Total time spent looking to park today: " + totalMinutes);

				response.getWriter().append("\n Average time spent looking to park today: " + (totalMinutes / numTimes));
				
				numTimes = 0; 
				
			} catch (Exception e) {
				e.printStackTrace();
			}
		} catch (NumberFormatException e) {
			e.printStackTrace(); 
		}
	}

}
