function addTag() {
    const tagInput = document.createElement('input');
    tagInput.type = 'text';
    tagInput.className = 'tagInput text';
    tagInput.setAttribute("required", "");
    tagInput.name = "tags[]"
    document.getElementById('tagContainer').appendChild(tagInput);
}

function addIngredient() {
    const ingredientInput = document.createElement('input');
    ingredientInput.type = 'text';
    ingredientInput.className = 'tagInput text';
    ingredientInput.setAttribute("required", "");
    ingredientInput.name = "ingredients[]"
    document.getElementById('ingredientContainer').appendChild(ingredientInput);
}

function required(){
    event.preventDefault();
    var title = document.getElementById("title");
    var picture = document.getElementById("picture");
    var tags = document.getElementById("tags");
    var ingredients = document.getElementById("ingredients");
    var mealtype = document.getElementById("mealType");
    var preptime = document.getElementById("prepTime");
    var servings = document.getElementById("servings");
    var bereiding = document.getElementById("instructions");

    if(title.value == "" || picture.value == "" || tags.value == "" || ingredients.value == "" || mealtype.value == "" || preptime.value == "" || servings.value == "" || bereiding.value == "")
    {
        document.getElementById("error").style.display = "flex";
        globalThis.scrollTo({ top: 0, left: 0, behavior: "smooth" });
        return false;
    }
    return true;
}


function addNew(){
    var title = document.getElementById("title");
    var picture = document.getElementById("picture");
    var tags = document.getElementById("tags");
    var ingredients = document.getElementById("ingredients");
    var mealtype = document.getElementById("mealType");
    var preptime = document.getElementById("prepTime");
    var servings = document.getElementById("servings");
    var bereiding = document.getElementById("instructions");

    if (!required()) return;
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "new.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("title=" + title + "&picture=" + picture + "&mealType=" + mealtype + "&prepTime" + preptime + "&servings=" + servings + "&bereiding=" + bereiding);
}