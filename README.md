# Rest API Logger for Magento 2

## Overview

**Rest API Logger** is a Magento 2 extension used to log all incoming REST API requests and their corresponding responses.
It helps developers and administrators monitor API activities, troubleshoot integration issues, and audit system behavior.

The extension stores log data in both:

* Database (Admin Grid View)
* Magento log files (`var/log`)

---

## Features

* Log all REST API requests
* Log API responses and status
* Store request payload
* Store response payload
* Admin grid to view API logs
* Export log data
* Mass purge logs from admin
* File-based logging for server debugging
* Timestamp tracking

---

## Logged Information

Each log record contains:

* Request Method (GET, POST, PUT, DELETE, etc.)
* API Endpoint / Path
* Request Input Data
* Response Output Data
* Status
* Created Time

---

## Log Storage

### Database Table

```
phong_logger_api
```

Accessible via Magento Admin.

### Log File

```
var/log/rest_api_logger.log
```

---

## Installation

### Method 1 — Manual Installation

1. Download the extension source code.

2. Copy the module to:

```
app/code/Phong/ApiLogger
```

3. Run Magento commands:

```bash
php bin/magento module:enable Phong_ApiLogger
php bin/magento setup:upgrade
php bin/magento cache:flush
```

---

### Method 2 — Installation via Composer

Run:

```bash
composer require phong/module-apilogger
```

Then execute:

```bash
php bin/magento module:enable Phong_ApiLogger
php bin/magento setup:upgrade
php bin/magento cache:flush
```

---

## Admin Usage

After installation, API logs can be viewed in Magento Admin Panel.

Example navigation:

```
Admin → System → Rest API Logger
```

---

## Recommendations

* Regularly purge old logs to avoid large database size.
* Logging can impact performance if API traffic is very high.
* Recommended for debugging, monitoring, and auditing purposes.

---

## Future Plan

### Auto Cleanup of Old Logs

* Support automatic removal of outdated log records from the database.
* Configurable retention period (e.g., remove logs older than X days).
* Scheduled cleanup via Magento Cron.
* Helps prevent database growth and improves system performance.

### GraphQL Logging Support

* Extend logging capability to capture GraphQL requests and responses.
* Record query name, variables, execution status, and response payload.
* Provide unified monitoring for both REST and GraphQL API traffic.

### URL-Based Logging Control

* Allow administrators to include or exclude specific API endpoints from logging.
* Support configuration of whitelist / blacklist URL patterns.
* Helps reduce unnecessary logging and improves performance in high-traffic environments.

---

## Compatibility

* Magento Open Source **2.4.6+**
* Magento Commerce **2.4.6+**
* PHP **8.1+**

---

## Author

Phong
