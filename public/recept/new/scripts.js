function addTag() {
    const tagInput = document.createElement('input');
    tagInput.type = 'text';
    tagInput.className = 'tagInput';
    document.getElementById('tagContainer').appendChild(tagInput);
}

function addIngredient() {
    const ingredientInput = document.createElement('input');
    ingredientInput.type = 'text';
    ingredientInput.className = 'tagInput';
    document.getElementById('ingredientContainer').appendChild(ingredientInput);
}

function required(){
    var title = getElementById("title");
    var picture = getElementById("picture");
    var tags = getElementById("tags");
    var ingredients =getElementById("ingredients");
    var mealtype = getElementById("mealType");
    var preptime = getElementById("prepTime");
    var servings = getElementById("servings");
    var instructions =getElementById("instructions");

    if(title.value=="" || picture.value=="" || tags.value=="" || ingredients.value=="" || mealtype.value=="" || preptime.value=="" || servings.value=="" || instructions.value=="")
    {
        document.getElementById("error").style.display = "flex";
        return false;
    }
    return true;
}