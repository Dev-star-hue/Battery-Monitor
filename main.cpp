
/**
 * @file main.cpp
 * @author your name (you@domain.com)
 * @brief 
 * @version 0.1
 * @date 2022-11-30
 * 
 * @copyright Copyright (c) 2022
 * 
 * Where is a will there is a way!!
 * 
 */


#include <ESP8266WiFi.h> 
#include <WiFiUdp.h>
#include <Arduino.h>
#include <ESP8266WebServer.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

//---- Add credentials for connection to local wi-fi network (webserver.h) -----//
const char* ssid = "ZTE-N99TK5";
const char* password = "seu6hbatbpa6";

//---- Add user and password for autentification (webserver.h) -----//
const char*  a_username = "admin";
const char* a_password = "admin";

//---- Add servername data will be posted and stored on (httpclient.h) ----//
const char* serverPost = "http://192.168.1.27/data/data_post.php";

const char* serverGet = "http://192.168.1.27/data/data_last.php";

//---- Initializing a global variables for webserver and httpclient ----//
ESP8266WebServer server(80);
HTTPClient http;
WiFiClient client;

//----------------Setup pin variable -----------------------//

const int analogInPin = A0;

//-------------- Declare function before use ---------------//
void main_page();
void recieveData();
void setUpServer();
void printIntro();
void sendData(String input);
String addUpdatedValues();

 
//--------------------Setup global variables---------------//

String finalMessage;
int sensorValue = 0; 
bool startUpload = false;

String web_page = R"rawliteral(

<!DOCTYPE html>
<html>

    <style>
        h1 {text-align: center;}
        form {text-align: center;}
        p1 {text-align: center;}

        </style>

<body>

<h1> Battery monitor: </h1>

<p1>For appropriate data processing it is necessary to add some information about user who owns certain measurement, device and battery.</p1>
<br>
<p1>Be careful usernames and device names should match with already created one. Data won't appear on webpage in case they won't match. </p1>
<br>
<p1>Firstly create a user in the system. Then add this device to the que and lastly use created data to fill tiles.</p1>
<br>
<p1>Please add information mentioned to the form below:</p1>

<br>
<br>

  <form action="/formdata_handler" method="get">
        
        <label>Information about user:</label><br><br>
        <label for="username">User name:</label><br>
        <input type="text" id="username" name="username"><br><br>

        <label>Devices information:</label><br><br>
        <label for="devicename">Device name:</label><br>
        <input type="text" id="devicename" name="devicename"><br><br>
        
        <label>Information about measured battery:</label><br><br>
        <label for="measurementID">MeasurementID:</label><br>
        <input type="text" id="measurementID" name="measurementID"><br>
        <label for="manufacturer">Manufacturer:</label><br>
        <input type="text" id="manufacturer" name="manufacturer"><br>
        <label for="capacity">Capacity:</label><br>
        <input type="text" id="capacity" name="capacity"><br>
        <label for="nominalvoltage">Nominal voltage:</label><br>
        <input type="text" id="nominalvoltage" name="nominalvoltage"><br>
        <label for="numberofcells">Number of cells:</label><br>
        <input type="text" id="numberofcells" name="numberofcells"><br>
        <label for="type">Type:</label><br>
        <input type="text" id="type" name="type"><br>
        
        <input type="submit" value="Submit">


      </form>






</body>



</html>



)rawliteral";

String web_page_submission = R"rawliteral(

<!DOCTYPE html>
<html>

    <style>
        h1 {text-align: center;}
        </style>

<body>

<h1> Measurement started! You can see results in the system! </h1>

</body>

</html>

)rawliteral";




void setup() {

  //setup serialmonitor on baudrate  
  Serial.begin(115200);

  //select mode
  WiFi.mode(WIFI_STA);

  //connect to wifi
  WiFi.begin(ssid, password);

  //wait for results 
  if (WiFi.waitForConnectResult() != WL_CONNECTED) {
    Serial.println("WiFi Connect Failed! Rebooting...");
    delay(1000);

  }else{
 
  setUpServer();
  printIntro();

  }
  
}
 
void loop() {
  
  server.handleClient();

  // read the analog value
  sensorValue = analogRead(analogInPin);
 
 
 //send data
if(startUpload==true){

  sendData(addUpdatedValues());

}
  delay(300);  


}

String addUpdatedValues(){

//Just one adc so just one sensorvalue unfortunately
String temperature = "555";
String voltage = (String)sensorValue;

return finalMessage+"&temperature="+temperature+"&voltage="+voltage;

}


String formData_handler(){


//-----------Retrive form data ----------// 

String measurementID = server.arg("measurementID");

String username = server.arg("username");

String devicename = server.arg("devicename");

String manufacturer = server.arg("manufacturer");
String capacity = server.arg("capacity");
String nominalvoltage = server.arg("nominalvoltage");
String numberofcells = server.arg("numberofcells");
String type = server.arg("type");




return "?measurementID="+measurementID+"&username="+username+"&devicename="+devicename+"&manufacturer="+manufacturer+"&capacity="+capacity+"&nominalvoltage="+nominalvoltage+"&numberofcells="+numberofcells+"&type="+type;

}





void main_page(){

 server.send(200,"text/html", web_page);
  


}

void submission_page(){

 server.send(200,"text/html", web_page_submission);

}

void printIntro(){

  //print bullshit into a monitor
  Serial.print("Open http://");
  Serial.print(WiFi.localIP());
  Serial.println("/ in your browser to see it working");


}

void setUpServer(){


  server.on("/", []() {

    //--------Request autentification---------//
     if (!server.authenticate(a_username, a_password)) {
      return server.requestAuthentication();
    }
   

    //---- open the mainpage   -----//
   return main_page();

  });

   server.on("/formdata_handler", []() {

    //----- get data -------//
   finalMessage = formData_handler();

   Serial.print(finalMessage);

    startUpload = true;

    //---- open the submission page  -----//
   return submission_page();

  });

  //start session
  server.begin();
  
  }





void sendData(String input){

//---- httpclinet setup -----//
if(WiFi.status()== WL_CONNECTED){

String message = serverPost+input;

Serial.print(message);

 // Your Domain name 
    http.begin(client, message);
    
    //content-type header
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    //message i wanna send
    int httpResponseCode = http.GET();


 if (httpResponseCode>0) {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);

      // if connection eatablished then do this
if (httpResponseCode == 200) { 
  Serial.println("Query Done"); 
  Serial.println(httpResponseCode); 
  String webpage = http.getString();    // Get html webpage output and store it in a string
  Serial.println(webpage + "\n"); 
}
    }
    else {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }
    // Free resources
    http.end();
  }
  else {
    Serial.println("WiFi Disconnected");
  }



}

