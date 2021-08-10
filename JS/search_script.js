let search_reference=document.getElementsByClassName("search-box");
let search_value="";
const filterBy=(value)=>{
    search_value=value;
    for(i of search_reference){
    // i.addEventListener("keyup",(event)=> {
        // if (event.keyCode === 13 && i.value.length>0) {
            // event.preventDefault();
            location.href=`./search.php?value=${i.value}&filterBy=${search_value}`;
        // }
    // });
    }
}

 
/*document.querySelector('.search-button').addEventListener("click",()=>{
    //event.preventDefault();
    // alert('Yo')
    location.href=`./search.php?value=${document.getElementsByClassName('search-box')[1].value}`;    
});*/
