# BatteryMonior

The aim of the project Remote Battery Management was to create a device for monitoring the current values of temperature and voltage on the battery, as well as collecting information about the devices. This system consists of a series of web pages that were created using php and html technologies as well as the Canvas.js library, web server, http client. Testing was done on a local network where the database system mysql was also running, which was used to store data about users, measuring devices and batteries themselves. Battery monitor allows adding any number of users. Each user can have any number of devices and each device can process any number of measurements. The measurement data can be uploaded from a .csv file or an external device can be used for measurement, such as Node MCU, which also contains a wi-fi module. However, the disadvantage of this device is only one ADC pin, which makes it impossible to connect two sensors without using an extension such as a multiplexer. The parameters of the ADC converter of this device are 10-bit and the tolerable values on the pin are in the range from 0-3.3 Volts, since the reference value is 3.3 Volts. Therefore, for measuring different batteries, it would be necessary to use external devices for scaling values or to use a voltage divider. When measuring data from an external device, it is necessary to connect to the device and confirm the data about the measured battery, as well as the user and the device on which the measurement is performed, so that the data is correctly synchronized.

![image](https://github.com/Stan-dev-star/BatteryMonior/assets/86577296/882ccfd6-3fc0-445f-b13f-33f028c2d236)

![image](https://github.com/Stan-dev-star/BatteryMonior/assets/86577296/f875559b-5bfa-495a-a761-506183d1df0d)

![image](https://github.com/Stan-dev-star/BatteryMonior/assets/86577296/afa2a731-5f85-4afc-b548-ce15a10978a4)

![image](https://github.com/Stan-dev-star/BatteryMonior/assets/86577296/99fc9ebf-8c2c-4fbf-95ca-921f3ad6c069)

![image](https://github.com/Stan-dev-star/BatteryMonior/assets/86577296/842d5ab0-99b2-46fd-99d1-c59c008c607a)

![image](https://github.com/Stan-dev-star/BatteryMonior/assets/86577296/f03c6a9e-b29c-4567-9d59-c3eb925bf4a7)

![image](https://github.com/Stan-dev-star/BatteryMonior/assets/86577296/852ae726-8bc5-4598-b4ab-70f79587e86e)

![image](https://github.com/Stan-dev-star/BatteryMonior/assets/86577296/a0b90953-92b8-4e26-9ee0-624f1e5e5f09)

![image](https://github.com/Stan-dev-star/BatteryMonior/assets/86577296/9b130ea6-fe5d-4ce3-a9c2-7ed6b02ff54f)

![image](https://github.com/Stan-dev-star/BatteryMonior/assets/86577296/41fe0397-9331-4671-a726-e8475c11705f)

