<?php

use LDAP\Result;

function selectAll($tableName) {
    global $conn;

    $query = 'SELECT * FROM '.$tableName;
    return $conn->query($query);

}

function insertUser($userName, $email, $hashedPassword, $roleId) {
    global $conn;

    $query = "INSERT INTO users(userName, password, email, roleId) VALUES(:userName, :password, :email, $roleId)";
    $prepare = $conn->prepare($query);
    $prepare->bindParam(':userName', $userName);
    $prepare->bindParam(':password', $hashedPassword);
    $prepare->bindParam(':email', $email);

    $result = $prepare->execute();

    return $result;
}

function userWithEmailExists($email) {
    global $conn;

    $query = "SELECT * FROM users WHERE email = :email";
    $prepare = $conn->prepare($query);
    $prepare->bindParam(':email', $email);
    $prepare->execute();

    $user = $prepare->fetch();
    //var_dump($user);
    if($user) {
        return true;
    } else return false;
}

function verifyLogin($email, $password) {
    global $conn;

    $query = "SELECT *, u.id AS userId FROM users u JOIN roles r on u.roleId = r.id WHERE u.email = :email";
    $prepare = $conn->prepare($query);
    $prepare->bindParam(':email', $email);
    $prepare->execute();

    $user = $prepare->fetch();
    //var_dump($user);
    if($user) {
            $hashedPassword = $user->password;
        if(password_verify($password, $hashedPassword)) {
            return $user;
        }
    } else return false;
    
}

function getSurveyQuestions() {
    global $conn;

    $query = 'SELECT * FROM survey WHERE active = 1';
    $result = $conn->query($query)->fetch();
    return $result;
}

function getSurveyAnswers($surveyId) {
    global $conn;

    $query = 'SELECT * FROM answers WHERE survey_id ='.$surveyId;
    $result = $conn->query($query);
    return $result;
}

/* function isAnswerIdExistant($id) {
    global $conn;

    $query = 'SELECT * FROM answers WHERE id = :id';
    $prepare = $conn->prepare($query);
    $prepare->bindParam(':id', $id);
    $prepare->execute();

    $result = $prepare->fetch();
    return $result;
}
*/

function doesAnswerBelongToSurvey($answerId, $surveyId) {
    global $conn;

    $query = 'SELECT * FROM survey INNER JOIN answers WHERE answers.id = :aId AND survey.id = :sId';
    $prepare = $conn->prepare($query);
    $prepare->bindParam(':aId', $answerId);
    $prepare->bindParam(':sId', $surveyId);
    $prepare->execute();

    $result = $prepare->fetch();
    if($result){
        return true;
    } else return false;
}

function userAlreadyAnswered($surveyId, $userId) {
    global $conn;

    $query = 'SELECT * FROM user_survey_answer WHERE user_id = :userId AND survey_id = :surveyId';
    $prepare = $conn->prepare($query);
    $prepare->bindParam(':userId', $userId);
    $prepare->bindParam(':surveyId', $surveyId);
    $prepare->execute();

    $result = $prepare->fetch();
    //var_dump($result);
    if($result){
        return true;
    } else return false;    

}

function insertAnswerSurveyUser($answerId, $surveyId, $userId) {
    global $conn;

    $query = 'INSERT INTO user_survey_answer (user_id, survey_id, answer_id) VALUES (:userId, :surveyId, :answerId)';

    $prepare = $conn->prepare($query);
    $prepare->bindParam(':userId', $userId);
    $prepare->bindParam(':surveyId', $surveyId);
    $prepare->bindParam(':answerId', $answerId);
    $result = $prepare->execute();

    return $result;

}

function getProducts($category, $sortType, $search) {
    global $conn;
    $categories = implode(',', $category);
    $query = 'SELECT products.id as id, products.name, products.description, images_for_products.url, images_for_products.alt, price.amount, products_categories.category_id FROM products INNER JOIN images_for_products ON products.image_id = images_for_products.id INNER JOIN price ON price_id = price.id INNER JOIN products_categories ON products.id = products_categories.product_id
    WHERE products_categories.category_id IN ('.$categories.') '; 
    
        $search = "%$search%";
        $query = $query.'AND products.name LIKE :search ';

 
    if($sortType == 'asc' || $sortType == 'desc') {
        $query = $query.'ORDER BY price.amount '.$sortType;
    }
    
    $prepare = $conn->prepare($query);
    $prepare->bindParam(':search', $search);

    //$prepare->bindParam(':sortType', $sortType, PDO::PARAM_STR);
    $prepare->execute();

    $products = $prepare->fetchAll();

    return $products;
}

function getAllProducts() {
    global $conn;

    $query = 'SELECT products.id as id, products.name, products.description, images_for_products.url, images_for_products.alt, categories.name as category, price.amount, products_categories.category_id FROM products INNER JOIN images_for_products ON products.image_id = images_for_products.id INNER JOIN price ON price_id = price.id INNER JOIN products_categories ON products.id = products_categories.product_id INNER JOIN categories ON products_categories.category_id = categories.id';
    $allProducts = $conn->query($query)->fetchAll();

    return $allProducts;

}

function getProductsById($id) {
    global $conn;

    $query = 'SELECT products.id as id, products.name, products.description, images_for_products.url, images_for_products.alt, price.amount, products_categories.category_id FROM products INNER JOIN images_for_products ON products.image_id = images_for_products.id INNER JOIN price ON price_id = price.id INNER JOIN products_categories ON products.id = products_categories.product_id
    WHERE products.id = :id'; 

    $prepare = $conn->prepare($query);
    $prepare->bindParam(':id', $id);
    $prepare->execute();

    $products = $prepare->fetchAll();
    return $products;
}

function insertContact($name, $email, $message) {
    global $conn;
    
    $query = 'INSERT INTO contacts (email, name, message) VALUES (:email, :name, :message)'; 

    $prepare = $conn->prepare($query);
    $prepare->bindParam(':email', $email);
    $prepare->bindParam(':name', $name);
    $prepare->bindParam(':message', $message);
    $result =  $prepare->execute();

    return $result;
}

function deleteProduct($id) {
    global $conn;
    
    $query = 'DELETE FROM products WHERE products.id = :id'; 

    $prepare = $conn->prepare($query);
    $prepare->bindParam('id', $id);
    $prepare->execute();

    $result = $prepare->rowCount();
    
    return $result;
}

function deleteContact($id) {
    global $conn;
    
    $query = 'DELETE FROM contacts WHERE contacts.id = :id'; 

    $prepare = $conn->prepare($query);
    $prepare->bindParam('id', $id);
    $prepare->execute();

    $result = $prepare->rowCount();
    
    return $result;
}

function insertReciept($productQuantityPair, $orderId) {
    global $conn;

    $query = "INSERT INTO receipts (product_id, order_id, quantity) VALUES (:product_id, :order_id, :quantity)";

    $prepare = $conn->prepare($query);
    $prepare->bindParam('product_id', $productQuantityPair['id']);
    $prepare->bindParam('order_id', $orderId);
    $prepare->bindParam('quantity', $productQuantityPair['quantity']);
   
    $result = $prepare->execute();

    return $result;
}

function insertOrder($userId) {
    global $conn;
    
    $query = "INSERT INTO orders (user_id) VALUES (:userId)";

    $prepare = $conn->prepare($query);
    $prepare->bindParam('userId', $userId);

    $success = $prepare->execute();

    if($success) {
        return $conn->lastInsertId();
    }
}

function updateProduct($id, $name, $categoryId, $priceId, $description) {
    global $conn;

    $query = "UPDATE products SET name = :name, description = :description, price_id = :priceId WHERE id = :id";

    $prepare = $conn->prepare($query);
    $prepare->bindParam('name', $name);
    $prepare->bindParam('priceId', $priceId);
    $prepare->bindParam('id', $id);
    $prepare->bindParam('description', $description);

    $successful = $prepare->execute();
    addCategoryProduct($id, $categoryId);

    return $successful;
}

function addCategoryProduct($productId, $categoryId) {
    global $conn;

    $query = "UPDATE products_categories SET category_id = :categoryId WHERE product_id = :productId";

    $prepare = $conn->prepare($query);
    $prepare->bindParam('productId', $productId);
    $prepare->bindParam('categoryId', $categoryId);
   
    $successful = $prepare->execute();

    return $successful;

}

function deleteCategory($id) {
    global $conn;
    
    $query = 'DELETE FROM categories WHERE categories.id = :id'; 

    $prepare = $conn->prepare($query);
    $prepare->bindParam('id', $id);
    $prepare->execute();

    $result = $prepare->rowCount();
    
    return $result;
}

function logPageAcess(){

    $visitedPage = $_SERVER['REQUEST_URI'];
    $datetime = date("d. m. Y. h:i:s");
    $userIp = $_SERVER['REMOTE_ADDR'];

    $user = "unauthorized";

    if(isset($_SESSION['user'])){
        $user = $_SESSION['user']->email;
    }

    $row = $visitedPage."__".$datetime."__".$userIp."__".$user."__"."\n";

    $file = fopen('data/pageAccess.txt', 'a');
    $write = fwrite($file, $row);
    if($write){
        fclose($file);
    }  
}
