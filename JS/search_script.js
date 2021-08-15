let search_reference=document.getElementsByClassName("search-box");
let search_value="";
const filterBy=(value)=>{
    search_value=value;
    for(i of search_reference){
        location.href=`./search.php?value=${i.value}&filterBy=${search_value}`;
    }
    
}

for(let i=0;i<search_reference.length;i++){
    search_reference[i].addEventListener('input',()=>{
        if(search_reference[i].value.length>0){
            console.log(document.getElementsByClassName("search-dropdown")[i].innerHTML)
            document.getElementsByClassName("search-dropdown")[i].disabled=false;
        }else{
            document.getElementsByClassName("search-dropdown")[i].disabled=true;
        }
    })
}
/*document.querySelector('.search-button').addEventListener("click",()=>{
    //event.preventDefault();
    // alert('Yo')
    location.href=`./search.php?value=${document.getElementsByClassName('search-box')[1].value}`;    
});*/
