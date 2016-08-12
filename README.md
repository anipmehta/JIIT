# JIIT
API for login into jiit webkiosk.
API Endpoints:
url:anip.xyz/icebreakerlogin.php
parameter: raw Application-json
          {
            "eno" : "13103551",
            "password" : "de",
            "dob" : "13-02-1995"
          }
response : Application/json
          {"response" : "success"} or {"response":"Invalid Password"}
