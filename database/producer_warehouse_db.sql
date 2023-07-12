--
-- Database: `producer_warehouse_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` INT(12) NOT NULL,
  `admin_username` VARCHAR(100) NOT NULL,
  `admin_password` VARCHAR(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table`admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'Philander', 'Philander'),
(2, 'Siyabonga', 'Siyabonga');

-- --------------------------------------------------------

--
-- Table structure for table`users`
--

CREATE TABLE `users` (
    `user_id` INT(12) NOT NULL,
    `user_username` VARCHAR(225) NOT NULL,
    `user_phone` VARCHAR(200) NOT NULL,
    `user_email` VARCHAR(225) NOT NULL,
    `user_password` VARCHAR(225) NOT NULL,
    `user_type` VARCHAR(225) NOT NULL,
    `user_verification` VARCHAR(225) NOT NULL,
    `created_at` TIMESTAMP NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
    `product_id` INT(12) NOT NULL,
    `user_id` INT(12) NOT NULL,
    `product_title` VARCHAR(225) NOT NULL,
    `product_titleSlug` VARCHAR(225) NOT NULL,
    `product_category` VARCHAR(225) NOT NULL,
    `product_pricing` VARCHAR(225) NOT NULL,
    `product_price` decimal(6,2) NOT NULL,
    `product_description` TEXT(225) NOT NULL,
    `product_date` DATE NOT NULL,
    `product_image` VARCHAR(225) NOT NULL,
    `product_file` VARCHAR(225) NOT NULL,
    `product_preview` VARCHAR(225) NOT NULL,
    `product_folderName` VARCHAR(225) NOT NULL,
    `product_code` VARCHAR(225) NOT NULL,
    `product_verification` VARCHAR(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
    `order_id` INT(12) NOT NULL,
    `user_id` INT(12) NOT NULL,
    `order_code` VARCHAR(225) NOT NULL,
    `order_total_price` DECIMAL(6,2) NOT NULL,
    `order_payment_status` VARCHAR(100) DEFAULT 'Payment Pending' NOT NULL,
    `order_date` DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
    `order_id` INT(12) NOT NULL,
    `product_id` INT(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
    `subscriber_id` INT(12) NOT NULL,
    `subscriber_email` VARCHAR(225) NOT NULL,
    `created_at` TIMESTAMP NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
    ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
    ADD PRIMARY KEY (`product_id`),
    ADD KEY `user_id` (`user_id`);  

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
    ADD PRIMARY KEY (`order_id`),
    ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
    ADD PRIMARY KEY (`order_id`, `product_id`),
    ADD KEY `order_id`(`order_id`),
    ADD KEY `product_id`(`product_id`);  

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
    ADD PRIMARY KEY (`subscriber_id`);    

-- --------------------------------------------------------

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
    MODIFY `admin_id` INT(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
    MODIFY `product_id` INT(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `user_id` INT(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
    MODIFY `order_id` INT(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
    MODIFY `subscriber_id` INT(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;  

-- --------------------------------------------------------    

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
    ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
    ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
    ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
    ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE; 