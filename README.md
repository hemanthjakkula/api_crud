# api_sarayulabs
## PHP scripts for the API
### Each Script receives the JSON data, parse it and then use it.
### All the common DB connection.
### When a new user is registered a token is generated ans stored in DB.
### When a request is made for the scripts then it checks for Authorization token in Header.
### If Token from DB matches with Token from Header then the Data According to the user is Sent or Received.
