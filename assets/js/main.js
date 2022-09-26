window.onload = function () {
    //getJSON("meni", fillMenu);


    if (window.location.pathname == "/grub-hub/index.php" || window.location.pathname == "/grub-hub/"
    || window.location.pathname == "/" || window.location.pathname == "/index.php")
    {
        $('.add-to-cart').click(addProductToCart);
        $('.add-to-cart').click(showPopUp);
        $('#loginToSubmit').click(function() {
            
            window.location.href = 'login.php';
        })
     $('input[name="answer"]').change(function () {
        $('#surveyError').addClass('hidden');
     })
        $('#submitSurvey').click(handleSurvey);
        $('.ch-data').change(function() {
            let filterData = getFilterdata();
        })
        

    }

    if (window.location.pathname == "/grub-hub/contact.php" || window.location.pathname == "/contact.php")
    {
        $(":button").click(validateContactForm);
    }

    if (window.location.pathname == "/grub-hub/cart.php" || window.location.pathname == "/cart.php")
    {
        
        if ((getFromLocalStorage('cart') == null) || getFromLocalStorage('cart').length == 0)
        {
            showEmptyCart()
        } else
        {
            let productIds = [];
            let products = getFromLocalStorage('cart');
            products.forEach(p => {
                productIds.push(p.id)
            })
            let data = {
                'ids':productIds
            }
            sendAjaxRequest('GET', data, 'getProductsById.php', fillCart, errorPage);
        }
    }

    if (window.location.pathname == '/grub-hub/register.php' || window.location.pathname == '/register.php')
    {
        let userNameField = $('#username');
        let emailField = $('#usermail');
        let passwordField = $('#userpassword');
        let emailError = 1;
        let passwordError = 1;
        let userNameError = 1;

        emailField.keyup(function () { 
            if(!validateUserEmail(emailField.val())) { 
                formErrorDisplay(emailField, 'Not a valid email address');
                emailError = 1;
            } else {
                formRemoveErrorDisplay(emailField);
                emailError = 0;
            }       
        });

        passwordField.keyup(function (){
            if(passwordField.val().length < 8) {
                formErrorDisplay(passwordField, 'Password must at least 8 characters long')
                passwordError = 1;
            } else {
                formRemoveErrorDisplay(passwordField);
                passwordError = 0;
            }
        });

        userNameField.keyup(function (){
            if(userNameField.val().length < 4) {
                formErrorDisplay(userNameField, 'Username must at least 3 characters long')
                userNameError = 1;
            } else {
                formRemoveErrorDisplay(userNameField);
                userNameError = 0;
            }
        });

        $('#contact-button').click(function () {
            let username = userNameField.val();
            let email = emailField.val();
            let password = passwordField.val();

            let data = {
                'userName': username,
                'email': email,
                'password': password
            }

            if(emailError == 0 && passwordError == 0 && userNameError == 0) {       
                sendAjaxRequest('POST', data, 'registration.php', registrationSuccess, registrationFailiure);
            } else { 
               
                if(!validateUserEmail(emailField.val())) { 
                    formErrorDisplay(emailField, 'Not a valid email address');
                    emailError = 1;
                } else {
                    formRemoveErrorDisplay(emailField);
                    emailError = 0;
                }       

                if(passwordField.val().length < 8) {
                    formErrorDisplay(passwordField, 'Password must at least 8 characters long')
                    passwordError = 1;
                } else {
                    formRemoveErrorDisplay(passwordField);
                    passwordError = 0;
                }

                if(userNameField.val().length < 4) {
                    formErrorDisplay(userNameField, 'Username must at least 3 characters long')
                    userNameError = 1;
                } else {
                    formRemoveErrorDisplay(userNameField);
                    userNameError = 0;
                }
                if(emailError == 0 && passwordError == 0 && userNameError == 0) {
                    
                    sendAjaxRequest('POST', data, 'registration.php', registrationSuccess, registrationFailiure);
                }
            }
            
        });
    }


    if (window.location.pathname == '/grub-hub/login.php' || window.location.pathname == '/login.php')
    {
        let emailField = $('#usermail');
        let passwordField = $('#userpassword');
        let emailError = 1;
        let passwordError = 1;

        emailField.keyup(function () { 
            if(!validateUserEmail(emailField.val())) {
                formErrorDisplay(emailField, 'Not a valid email address')
                emailError = 1;
            } else {
                formRemoveErrorDisplay(emailField);
                emailError = 0;
            }
        });
        passwordField.keyup(function (){
            if(passwordField.val() == '') {
                formErrorDisplay(passwordField, 'Password cannot be empty')
                passwordError = 1;
            } else {
                formRemoveErrorDisplay(passwordField);
                passwordError = 0;
            }
        });

        $('#contact-button').click(function () {
            let email = emailField.val();
            let password = passwordField.val();

            let data = {
                'email': email,
                'password': password
            }
            if(emailError == 0 && passwordError == 0) {
                sendAjaxRequest('POST', data, 'login.php', loginSuccess, loginFaliure);
            } else {
                if(emailError) {
                    if(!validateUserEmail(emailField.val())) {
                        formErrorDisplay(emailField, 'Not a valid email address')
                        emailError = 1;
                    } else {
                        formRemoveErrorDisplay(emailField);
                        emailError = 0;
                    }
                }
                if(passwordError) {
                    if(passwordField.val() == '') {
                        formErrorDisplay(passwordField, 'Password cannot be empty')
                        passwordError = 1;
                    } else {
                        formRemoveErrorDisplay(passwordField);
                        passwordError = 0;
                    }   
                }
                if(emailError == 0 && passwordError == 0) {
                    sendAjaxRequest('POST', data, 'login.php', loginSuccess, loginFaliure);
                }

            }
        });  
    }

    if(window.location.pathname =='/admin.php' || window.location.pathname == '/grub-hub/admin.php'){
        $('#admin-products').click(function() {
            sendAjaxRequest('get', {'data':'data'}, 'getAllProducst.php', showAdminProucts, adminError);                                                                
        })

        $('#admin-contacts').click(function() {
            sendAjaxRequest('get', {'data':'data'}, 'getAllContacts.php', showAdminContacts, adminError);                                                                
        })

        $('#admin-users').click(function() {
            sendAjaxRequest('get', {'data':'data'}, 'getAllUsers.php', showAdminUsers, adminError);                                                                
        })

        $('#admin-categories').click(function() {
            sendAjaxRequest('get', {'data':'data'}, 'getAllCategories.php', showAdminCategories, adminError);    
        });

        $('#admin-page-access').click(function() {
            sendAjaxRequest('get', {'data':'data'}, 'getPageAccessData.php',showPageAccess, adminError);    
        });

        $('#close').click(function() {
            $('#whole-window-popup').css('display', 'none');
        })
    }
   
   // console.log(window.location.pathname);
}


function showEmptyCart() {
    let result = `
    <div id="cart-error">
        <p>No products currently in cart</p>
    </div>`;

    $('#product-cart').html(result);
    //$('#checkout').html('');

}

function getJSON(file, callback){
    $.ajax({
        url:"grub-hub/json/" + file + ".json",
        method: "get",
        dataType:"json",
        success: function(response) {
            callback(response);
        },
        error : function(err) {
            //console.log(err);
        }
    });
}

function fillGallery(data) {
    //console.log(data);
    var output = '<div id="tm-gallery-page-pizza" class="tm-gallery-page">';
    if(data.length != 0){
        data.forEach(element => {
            output += `
            <article class="col-lg-3 col-md-4 col-sm-6 col-12 tm-gallery-item">
            <figure>
                <img src="assets/img/gallery/${element.url}" alt=${element.alt} class="img-fluid tm-gallery-img" />
                <figcaption>
                    <h4 class="tm-gallery-title">${element.name}</h4>
                    <p class="tm-gallery-description">${element.description}</p>
                    <div class="price-cart">
                        <p class="tm-gallery-price">${element.amount}$</p>
                        <input type="button" data-id="${element.id}" class="tm-btn tm-btn-success tm-btn-right add-to-cart" value="Add to cart"/>
                    </div>
                </figcaption>
            </figure>
         
            </article>
            `;
        
        });
    } else {
        output = `
        <div id="product-error">
            <p>No products that match your criteria</p>
        </div>`; //TODO
    }
    document.getElementById("gallery").innerHTML = output;
    $('.add-to-cart').click(addProductToCart);
    $('.add-to-cart').click(showPopUp);
    

} 

function validateContactForm() {
    let name = document.getElementById("username");
    let email = document.getElementById("usermail");
    let message = document.getElementById("message");
    let errorNb = 0;
    let valMail, valName
    let reEmail = /\S+@\S+\.\S+/;
    let reName = /^[A-Z][a-z]{1,14}$/;
    //name.onclick(console.log('dad'))

    if (reEmail.test(email.value))
    {
        valMail = true;
    } else
    {
        valMail = false;
        errorNb++
    }
   
    if (reName.test(name.value))
    {
        valName = true;
    } else
    {
        valName = false;
        errorNb++
    }
    console.log(errorNb);
    if (message.value == "")
    {
        displayFormError(message, 'Message cannot be empty');
        errorNb++
    } else
    {
        removeErrorFormElement(message);
    }
    if (message.value.length > 500)
    {
        displayFormError(message, 'Message too long');
        errorNb++
    } else
    {

    }
   
    if (!valMail)
    {
        displayFormError(email, 'Not a valid email address');
    } else
    {
        removeErrorFormElement(email);
    }

    if (!valName)
    {
        displayFormError(name, 'Name must be atleast 2 characters long and start with a capital letter');
    } else
    {
        removeErrorFormElement(name);
    }
   
    if (errorNb == 0)
    {
        data = {
            'email':email.value,
            'name':name.value,
            'message':message.value
        }
        sendAjaxRequest('POST', data, 'handleContact.php', contactSuccess, errorPage);
    }

}

function contactSuccess(data) {
    let message = $('#message');
    console.log(data);
    displayFormSuccess(message, data.msg);
}

function validateUserEmail(email) {
    let reEmail = /\S+@\S+\.\S+/;
    if(reEmail.test(email)){
        return true
    } else 
    {
        return false
    }
  
}

function addProductToCart() {
    let productId = $(this).data('id');

    var productsInCart = getFromLocalStorage('cart');

    if (productsInCart)
    {
        if (productAlreadyInCart(productId))
        {
            incrementProductInCart()
        } else
        {
            addProductToCartFirstTime()
        }
    } else
    {

        firstProductToCart();
    }



    function firstProductToCart() {
        let data = [];
        data[0] = {
            id: productId,
            quantity: 1
        }
        setToLocalStorage(data, 'cart')
    }

    function incrementProductInCart() {
        for (let product of productsInCart)
        {
            if (product.id == productId)
            {
                product.quantity++;
                break
            }
        }
        setToLocalStorage(productsInCart, 'cart');
    }

    function addProductToCartFirstTime() {
        data = {
            id: productId,
            quantity: 1
        }
        productsInCart.push(data);
        setToLocalStorage(productsInCart, 'cart');
    }

    function productAlreadyInCart(id) {
        return productsInCart.filter(x => x.id == productId).length
    }
}

function fillCart(data) {
   //data = JSON.parse(data);
    let result = `
    <table class="product-table table-striped">
				<thead>
					<tr>
                        <th>Product</th>
						<th>Product name</th>
                        <th>Quantity</th>
                        <th>Price</th>
						<th>Price sum</th>
						<th>Remove</th>
					</tr>
				</thead>
                <tbody>
				
    `;
    let productsInStorage = getFromLocalStorage('cart');
  /*   let fullProductsInStorage = data.filter(x => {
        for (let product of productsInStorage)
        {   
            if (x.id == product.id)
            {
                x.quantity = product.quantity
                return true
            }
        }
    }) */
    data.forEach(element => {
        for(let product of productsInStorage) {
            if(element[0].id == product.id) {
                element[0].quantity = product.quantity;
            }
        }
    });
    //console.log(fullProductsInStorage);
    data.forEach(function(product) {
        result += `
        <tr>
            <td><img src="assets/img/gallery/${product[0].url}" alt="${product[0].alt}" id="small-picture"/></td>
            <td>${product[0].name}</td>
            <td>${product[0].quantity}</td>
            <td>${product[0].amount}</td>
            <td>${product[0].quantity * product[0].amount}</td>
            <td><input type="button" data-id="${product[0].id} "class="tm-btn tm-btn-danger tm-btn-right remove-from-cart" value="Remove"/>
            </td>`
    })
    result += `</tbody>
    </table>
    <td>
    `
    if (productsInStorage.length == 0 || productsInStorage == null)
    {
        result = `
        <div id="cart-error">
            <p>No products currently in cart</p>
        </div>`;
    }


    $('#product-cart').html(result);
    $('.remove-from-cart').click(removeFromLocalStorage);
    $('.remove-from-cart').click(updateCart);
    $('#checkout').removeClass('hidden');
    $('#checkout').click(checkout);
}

function updateCart() {
    $(this).parent().parent().remove();
    if(getFromLocalStorage('cart').length == 0) {
        let result = `
        <div id="cart-error">
            <p>No products currently in cart</p>
        </div>`
        $('#product-cart').html(result);
    }
}

function checkout() {
    let productsInCart = getFromLocalStorage('cart');
    let productQuantityPairs = [];
    productsInCart.forEach(pair => {
        productQuantityPairs.push([pair.id, pair.quantity]);
    });

    let data = {
        "productQuantityPairs":[1,2]
    };

    sendAjaxRequest('POST', {'data':productsInCart}, 'insertOrder.php', showThankYouCart, orderError);

    localStorage.clear();
    showThankYouCart();
      

}

function orderError(message) {

}

function showThankYouCart() {
    $('#product-cart').html(`
    <div id="cart-error">
        <p>Thank you for your purchase</p>
    </div>`);
    $('#checkout').html('');  
}


function removeFromLocalStorage() {
    let products = getFromLocalStorage('cart');
    let filtered = products.filter(p => $(this).data('id') != p.id);
    setToLocalStorage(filtered, 'cart');
}

function setToLocalStorage(data, id) {
    localStorage.setItem(id, JSON.stringify(data));
}

function getFromLocalStorage(id) {
    return JSON.parse(localStorage.getItem(id))
}

function displayFormError(element, message) {
    $(element).addClass('error');
    $(element).next().removeClass('hidden');
    $(element).next().html(message);
}

function removeErrorFormElement(element) {
    $(element).removeClass('error');
    $(element).next().addClass('hidden');
}

function displayFormSuccess(element, message) {
    $(element).next().addClass('success-text');
    $(element).next().removeClass('error-text');
    $(element).next().removeClass('hidden');
    $(element).next().html(message);
}

function showPopUp() {
    $('#pop-up').removeClass('hidden');
    setTimeout(() => { $('#pop-up').addClass('hidden') }, 2000);
}

function sendAjaxRequest(method, data, url, successFunction, errorFunction) {
    $.ajax({
        method: method,
        url: "models/" + url,
        data: data,
        dataType: "JSON",
        success: function (response) {
            successFunction(response)
        },
        error: function (xhr) {
            errorFunction((xhr))
        }
    });
}

function registrationSuccess(data) {
    window.location.href = 'login.php';
}

function registrationFailiure(data) {
    let email = $('#usermail');
    removeErrorFormElement(email);
    if(data.responseJSON.email) {
        formErrorDisplay(email, data.responseJSON.email);
    }
}
function loginSuccess(path) {
    //console.log(path.msg);
    window.location.href = 'index.php'
}

function loginFaliure(data) {
    let email = $('#usermail');
    let password = $('#userpassword');
    removeErrorFormElement(email);
    removeErrorFormElement(password);
    //console.log(data.responseJSON);
    if (data.responseJSON.email)
    {
        formErrorDisplay(email, data.responseJSON.email)
    }
    if (data.responseJSON.password)
    {
        formErrorDisplay(password, data.responseJSON.password)
    }
}

function formErrorDisplay(element, errorMessage) {
    $(element).next().removeClass('hidden');
    $(element).next().html(errorMessage);
}


function formRemoveErrorDisplay(element) {
    $(element).next().addClass('hidden');
    $(element).next().html('');
}

function surveyFaliure(data) {
    console.log(data);
    $('#surveyError').removeClass('hidden');
    $('#surveyError').html(data.responseJSON.error);
}

function surveySuccess() {

}

function handleSurvey() {
    $('#surveyError').addClass('hidden');
    let answer;
    if(document.querySelector('input[name="answer"]:checked')) {
        answer = document.querySelector('input[name="answer"]:checked').value;
    } else {
        $('#surveyError').removeClass('hidden');
        $('#surveyError').html('Please select an option');
    }
    
    let survey = $('#submitSurvey').data('id');
    answer = parseInt(answer);
    survey = parseInt(survey);
    if(Number.isSafeInteger(answer) && Number.isSafeInteger(survey)) {
        data = {
            'answerId':answer,
            'surveyId':survey
        }
        sendAjaxRequest('POST', data, 'handleSurvey.php', surveySuccess, surveyFaliure);
    } 
}

function getFilterdata() {
    let selectedCategories = [];
    let selectedSortType;
    let searchTerm;
    $('.category:checked').each(function (el) {
        selectedCategories.push($(this).val());
    });
    if(selectedCategories.length == 0) {
        $('.category').each(function (el) {
            selectedCategories.push($(this).val());
        });
    }
    searchTerm = $('#search').val()

    selectedSortType = $('#sort').val();
    let data = {
        'categories':selectedCategories,
        'sort':selectedSortType,
        'search':searchTerm
    }
    sendAjaxRequest('GET', data, 'handleProducts.php', showProducts, error);
}

function showProducts(data) {
    fillGallery(data);
}

function error(data) {
    //fillGallery(data)
}

function errorPage(data) { 
    //console.log(data)
}

function displayTableHeader(colums) {
    let result = ` <table class="product-table table-striped">
    <thead>
        <tr>`;

    colums.forEach(column => {
        result += `
        <th>${ column }</th>`;
    });
    result += `
        </tr>
    </thead>
    <tbody>`;

    return result;
}

function showAdminProucts(data) {
    const colums = ['Id', 'Name', 'Price', 'Category', 'Delete', 'Edit'];
    let result = displayTableHeader(colums);

    data.forEach(function(product) {
        result += `
        <tr>
        <td>${product.id}</td>
        <td>${product.name}</td>
        <td>${product.amount} &euro;</td>
        <td>${product.category}</td>
        <td><input type="button" data-id="${product.id}"class="tm-btn tm-btn-danger delete-product tm-btn-right" value="Delete"/>
        <td><input type="button" data-id="${product.id}"class="tm-btn tm-btn-primary edit-product tm-btn-right" value="Edit"/>
        </td>`;
    });

    $('#admin-controls').html(result);
    $('.delete-product').click(function() {
        let id = $(this).data('id');
        let data = {
            'id':id
        }
        sendAjaxRequest('POST', data, 'deleteProduct.php', displayAdminPopUp, displayAdminPopUp);
    });
    $('.edit-product').click(function() {
        let id = $(this).attr('data-id');
        let product = data.filter(x => x.id == id);
        let formHtml = `
        <input type="text" id="product-name" class="form-control" value="${product[0].name}">
        <div class="form-group">
            <label for="product-category"></label>
            <select name="product-category" id="product-category" class="form-control"></select>
        </div>
        <div class="form-group">
        <label for="product-price"></label>
        <select name="product-price" id="product-price" class="form-control"></select>
        </div>
        <div class="form-group">
        <label for="product-description">Description</label>
        <textarea name="description" id="product-description" cols="30" rows="10" class="form-control"> ${product[0].description}</textarea>
        </div>
                <div class="tm-btn tm-btn-success tm-btn-right" data-id="${product[0].id}" id="edit-product">Submit</div>`;
        $('#edit-data').html(formHtml);
        $('#product-category').html($('#categories-hidden').html());
        $('#product-price').html($('#prices-hidden').html());
        $('#whole-window-popup').css('display', 'block');
        $('#edit-product').click(function() {
            let data = {
                'id':$(this).data('id'),
                'name':$('#product-name').val(),
                'categoryId':$('#product-category').val(),
                'priceId':$('#product-price').val(),
                'description':$('#product-description').val(),
            }
            sendAjaxRequest('POST', data, 'updateProduct.php' , refreshPage, displayAdminPopUp);
        });
    });

}

function showAdminCategories(data) {
    const colums = ['Id', 'Name', 'Delete', 'Edit//TODO'];
    let result = displayTableHeader(colums);

    data.forEach(function(category) {
        result += `
        <tr>
        <td>${category.id}</td>
        <td>${category.name}</td>
        <td><input type="button" data-id="${category.id}"class="tm-btn tm-btn-danger delete-category tm-btn-right" value="Delete"/>
        <td><input type="button" data-id="${category.id}"class="tm-btn tm-btn-primary edit-category tm-btn-right" value="Edit"/>
        </td>`;
    });
    $('#admin-controls').html(result);
    $('.delete-category').click(function() {
        let id = $(this).data('id');
        let data = {
            'id':id
        }
        sendAjaxRequest('POST', data, 'deleteCategory.php', refreshAdminCategories, displayAdminPopUp);
    });
}

function showAdminContacts(data) {
    let result = ` <table class="product-table table-striped">
    <thead>
        <tr>
            <th>Contact Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>`;

    data.forEach(function(contact) {
        result += `
        <tr>
        <td>${contact.id}</td>
        <td>${contact.name}</td>
        <td>${contact.email}</td>
        <td>${contact.message}</td>
        <td><input type="button" data-id="${contact.id}"class="tm-btn tm-btn-danger delete-contact tm-btn-right" value="Delete"/>
        </td>`;
    });

    $('#admin-controls').html(result);
    $('#admin-controls').html(result);
    $('.delete-contact').click(function() {
        let id = $(this).data('id');
        let data = {
            'id':id
        }

        sendAjaxRequest('POST', data, 'deleteContact.php', displayAdminPopUp, displayAdminPopUp);
    });
    
}

function showAdminUsers(data) {
    let result = ` <table class="product-table table-striped">
    <thead>
        <tr>
            <th>User Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Delete //TO DO</th>
        </tr>
    </thead>
    <tbody>`;

    data.forEach(function(user) {
        result += `
        <tr>
        <td>${user.id}</td>
        <td>${user.userName}</td>
        <td>${user.email}</td>
        <td><input type="button" data-id="${user.id}"class="tm-btn tm-btn-danger delete-user tm-btn-right" value="Delete"/>
        </td>`;
    });

    $('#admin-controls').html(result);
}

function showPageAccess(data) {
    const colums = ['Page', 'Time', 'Ip address', 'User'];
    let result = displayTableHeader(colums);

    data.forEach(function(row) {
        result += `
        <tr>
        <td>${row[0]}</td>
        <td>${row[1]}</td>
        <td>${row[2]}</td>
        <td>${row[3]}</td>
        </td>`;
    });

    $('#admin-controls').html(result);

}


function displayAdminPopUp(message) {
    console.log(message);
    $('#admin-pop-up').removeClass('hidden');
    $('#admin-pop-up').html(message.responseJSON.msg);
    setTimeout(() => { $('#admin-pop-up').addClass('hidden') }, 5000);
    //sendAjaxRequest('get', {'data':'data'}, 'getAllProducst.php', showAdminProucts, adminError);
}
function refreshPage() {
    location.reload();
}

function refreshAdminCategories() {
    sendAjaxRequest('get', {'data':'data'}, 'getAllCategories.php', showAdminCategories, adminError);    
}

function refreshAdminProducts() {
    sendAjaxRequest('get', {'data':'data'}, 'getAllProducst.php', showAdminProucts, adminError);  
}

function adminError () {

}

