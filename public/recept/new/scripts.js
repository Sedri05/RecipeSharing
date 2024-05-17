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
    event.preventDefault();
    var title = document.getElementById("title");
    var picture = document.getElementById("picture");
    var tags = document.getElementById("tags");
    var ingredients = document.getElementById("ingredients");
    var mealtype = document.getElementById("mealType");
    var preptime = document.getElementById("prepTime");
    var servings = document.getElementById("servings");
    var instructions = document.getElementById("instructions");

    if(title.value == "" || picture.value == "" || tags.value == "" || ingredients.value == "" || mealtype.value == "" || preptime.value == "" || servings.value == "" || instructions.value == "")
    {
        document.getElementById("error").style.display = "flex";
        globalThis.scrollTo({ top: 0, left: 0, behavior: "smooth" });
        return false;
    }
    return true;
}