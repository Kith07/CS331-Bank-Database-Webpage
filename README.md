# Web Application Program Design
Our web application builds a basic User Interface for pages/features on a Bank website. It first connects to our Oracle Database utilizing our PHP script and NJIT’s Oracle server prophet.njit.edu. The web application has several different pages, each serving a different purpose for the Bank project with the ultimate goal of being able to successfully run our 4 queries from Phase II of our project. There were quite a few design and stylistic choices made for building this from the ground up. Further explanations are provided below:

## Connecting to DB:
![image](https://github.com/user-attachments/assets/67b3ec1b-7453-4240-91d3-143c4ed9daff)

The PHP script utilizes its innate PDO objects to connect to our Oracle Server using our set-up username and password.

## Login Page:
![image](https://github.com/user-attachments/assets/8931071d-999f-4571-b099-729100d21482)

![image](https://github.com/user-attachments/assets/ff38e083-1613-4795-a8bf-8d855228f390)

The code for our login page as well as its screenshot are pasted above. In order to log into our web application, a separate Users table was created that stored three columns: id, email, and password values. After initially inserting records into our newly created Users table, we were able to use those same values to log in to our Bank web application.

## Home Page:
![image](https://github.com/user-attachments/assets/4d58879a-a11a-4419-83fe-ec5bf1a1f0d0)

![image](https://github.com/user-attachments/assets/1b258967-6b31-462a-aca5-bfee449c27e2)

After successfully logging in, the user is navigated to our home page which was also built using our custom HTML and CSS styling. The page has three separate navigation buttons that each lead to a different entity page where we will run our queries. We chose the 3 entities that corresponded to our queries from Phase II and created those pages so that the fetched data could be presented on the screen.

## Employee Page:
![image](https://github.com/user-attachments/assets/2d54c6fe-59ec-4510-b2b1-80241388717c)

![image](https://github.com/user-attachments/assets/816ada8d-a7d8-4310-b65c-0a3073018d60)

This is our first Employee page that lists the records/data fetched from running the query: 

"SELECT EmployeeSSN, COUNT(*)
FROM Employee JOIN Dependent ON Employee.SSN = Dependent.EmployeeSSN
GROUP BY EmployeeSSN
HAVING COUNT(*) > 2"

It essentially prints out the number of employees in our Branch database that have more than 2 dependents. The results match the exact output we received in our Oracle database as well, indicating that a successful connection was established and the query was parsed well.

## Customer Page:
![image](https://github.com/user-attachments/assets/fb38e628-9586-45a8-8a6f-f66604b86e30)

![image](https://github.com/user-attachments/assets/b99bb35f-f60d-4ff7-9e9f-962501fc45ab)

This is our second page built for accessing records from our Customers table. The results on display were fetched from the following query: 

“WITH CustData (AcctNum, SSN, CustName, BID) AS (
    SELECT AccountNumber, SSN, Name, Branch_ID
    FROM (Customer NATURAL JOIN Holds) NATURAL JOIN Maintains)
    SELECT DISTINCT CUSTNAME Name, SSN, Name Branch_Name
    FROM Branch JOIN CustData ON CustData.BID = Branch.Branch_ID
    WHERE Assets >= ALL
    (SELECT Assets FROM BRANCH)"

This query is responsible for retrieving the name and SSN of Customers and which branch they use, assuming they use the branch that currently holds the most assets of any bank. Once again this query is elaborated on further below.

## Accounts Page:
![image](https://github.com/user-attachments/assets/14491baf-303c-401d-96b6-86678ceca326)

![image](https://github.com/user-attachments/assets/2f8aca9a-23f8-4574-a615-fc23b80a2dd6)

This is our third and last page associated with our Accounts entity and utilizes the query:

"SELECT AVG(Balance) as Balances, LastAccessDate
FROM Account
WHERE Balance > 0
GROUP BY LastAccessDate
ORDER BY Balances DESC"

Such a statement fetches the balances and last access dates from our Accounts table of users who currently have more than 0 dollars in their accounts, and organizes/sorts it in descending order. 

To summarize our design choices for this web application design, we stuck to our existing database tables and strategically reused our queries from Phase II containing HAVING, ORDER BY, and WITH clauses to demonstrate our practical understanding of what we’re retreating from the database. The login, home, and logout pages where also designed to elevate user experience and provide a more holistic view of what Bank webpages could look like.
