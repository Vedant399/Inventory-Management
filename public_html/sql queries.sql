CREATE TABLE invoice (
    invoice_no INT(11) PRIMARY KEY AUTO_INCREMENT,
    customer_name VARCHAR(250) NOT NULL,
    order_date DATE NOT NULL,
    sub_total DOUBLE NOT NULL,
    gst DOUBLE NOT NULL,
    discount DOUBLE NOT NULL,
    net_total DOUBLE NOT NULL,
    paid DOUBLE NOT NULL,
    due DOUBLE NOT NULL,
    payment_type TEXT(20) NOT NULL
    );

CREATE TABLE invoice_details (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    invoice_no INT(11) NOT NULL,
    product_name VARCHAR(250) NOT NULL,
    price DOUBLE NOT NULL,
    qty INT(11) NOT NULL,
    FOREIGN KEY (invoice_no) REFERENCES invoice(invoice_no)
    );

CREATE TABLE purchase(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    product_id INT(11) NOT NULL,
    stock_added INT(11) NOT NULL,
    purchase_date DATE NOT NULL,
    FOREIGN KEY(product_id) REFERENCES products(pid)

);
CREATE TABLE products(

    pid INT(11) PRIMARY KEY AUTO_INCREMENT,
    cid INT(11) NOT NULL,
    bid INT(11) NOT NULL,
    product_name VARCHAR(200) NOT NULL,
    product_price DOUBLE NOT NULL,
    product_stock INT(11) NOT NULL,
    added_date DATE NOT NULL,
    p_status ENUM('1','0') NOT NULL,
    FOREIGN KEY(cid) REFERENCES categories(cid),
    FOREIGN KEY(bid) REFERENCES brands(bid)
    

)
CREATE TABLE payment_details(

    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    invoice_no INT(11) NOT NULL,
    paid_time DOUBLE NOT NULL,
    payment_date DATE NOT NULL,
    FOREIGN KEY(invoice_no) REFERENCES invoice(invoice_no)

)

CREATE TABLE customers(

    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    company_name VARCHAR(200) NOT NULL,
    gst VARCHAR(20) NOT NULL,
    mobile VARCHAR(11) NOT NULL,
    address VARCHAR(200) NOT NULL,
    pin VARCHAR(15) NOT NULL

)
CREATE TABLE suppliers(

    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    supplier_name VARCHAR(200) NOT NULL,
    supplier_gst VARCHAR(20) NOT NULL,
    supplier_mobile VARCHAR(11) NOT NULL,
    supplier_address VARCHAR(200) NOT NULL,
    supplier_email VARCHAR(100) NOT NULL,
    supplier_city VARCHAR(15) NOT NULL

)