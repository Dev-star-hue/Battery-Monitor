# Battery Monitor (Remote Battery Management)

The aim of the "Remote Battery Management" project was to create a system for monitoring real-time temperature and voltage values of batteries, alongside collecting relevant hardware metadata.

## Overview & Architecture
The system consists of a series of web pages built using **PHP**, **HTML**, and the **Canvas.js** library, supported by a web server and an HTTP client. Testing was conducted on a local network utilizing a **MySQL database** to store information regarding users, measurement devices, and the batteries themselves.

### Key Features:
* **Multi-User & Multi-Device Support:** The application allows for an arbitrary number of users. Each user can manage multiple devices, and each device can process multiple measurements.
* **Flexible Data Ingestion:** Measurement data can be uploaded via a `.csv` file or gathered dynamically using an external microcontroller.

## Hardware & NodeMCU Integration
Data collection can be performed using an external device such as the **NodeMCU**, which includes an integrated Wi-Fi module. 

* **ADC Limitations:** A notable constraint of this microcontroller is its single ADC pin, making it impossible to connect multiple sensors directly without an expansion component like a multiplexer.
* **Resolution & Scaling:** The ADC features a 10-bit resolution with a tolerable input range of $0\text{--}3.3\,\text{V}$ (based on a $3.3\,\text{V}$ reference). Consequently, measuring different battery voltages requires external scaling circuitry or a voltage divider.
* **Data Synchronization:** When collecting data from an external device, users must connect to the device and verify details concerning the battery, user, and measuring device to ensure proper data synchronization.

## Screenshots

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
