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