# product-manager
A RESTful API for product management 

##Requirements
Apache webserver, PHP 5.4+, MySQL, Git, Composer(optional)


##Installation
To get started, clone this source code:
 `https://github.com/carlitosspot/product-manager.git`


##DB Credentials/Configurations
Navigate in your local folder/directory where the repo has been cloned
1. Add your own db configurations in the file config/local.ini
2. Using phpAdmin or a similar too, create the database you listed in the local.ini file


##Create schema
In the directory where the repo is, execute the following command line:
`$ vendor/bin/doctrine orm:schema-tool:create` 


##Usage Example
Using curl or anyother tool like postman, GET/POST/PUT/DELETE can be used as such:


````// get a product

$ curl -i -X GET http://yourdomain/product-ms/src/index.php/products/1
```


`// get a products
$ curl -i -X GET http://yourdomain/product-ms/src/index.php/products
`

**NOTE I've included all dependencies so everything should work out of the box.