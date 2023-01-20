// let b_image = document.getElementById('b_image');
// let s_image = document.getElementById('s_image').getElementsByTagName('img');

// let center = document.querySelector('.center');
// let bug = document.querySelector('.bug');

// bug.addEventListener('click',()=>{
//     bug.classList.toggle('active');
//     center.classList.toggle('active');
// })



// function incNumber(){
//     var c = parseInt(document.getElementsByTagName("input")[0].value);
//     c++;
//     document.getElementsByTagName("input")[0].value = c;
//     document.getElementById("display").innerHTML = c;
// }


// function decNumber(){
//     var c = parseInt(document.getElementsByTagName("input")[0].value);
//     c--;
//     document.getElementsByTagName("input")[0].value = c;
//     document.getElementById("display").innerHTML = c;
// }

// let center = document.querySelector('.center')
// let bug = document.querySelector('.bug')

// bug.addEventListener('click',()=>{
//     bug.classList.toggle('active');
//     center.classList.toggle('active');
// })








// for(let i=0; i < s_image.length; i++){
//     s_image[i].addEventListener('click', full_image)
// }

// function full_image(){
//     let imageSRC = this.getAttribute('src')
//     b_image.innerHTML = "<img src=" + imageSRC + " width='400' height='400'>"
// }

     
    // for(let i =0; i<4; i++){
    //      smallImg[i].onclick = function(){
    //      mainImg.src = smallImg[i].src;
    // }
 
    // }

    let center = document.querySelector('.center')
let bug = document.querySelector('.bug')
console.log(bug);

bug.addEventListener('click',()=>{
    bug.classList.toggle('active');
    center.classList.toggle('active');
})
