const ids=(val)=>{
	let value=document.getElementById(val);
	return value;
};
const classes=(val)=>{
	let values=document.getElementsByClassName(val);
	return values;
};
const displayFile=()=>{
	let input_files=ids('fileInput');
	for(let i of input_files.files){
		let reader= new FileReader();
		ids('display_file_name').innerText=i.name;
		/*reader.onload=()=>{
			//Create Image tag
			let img=document.createElement('img');
			img.classList.add('display');
			//set src attribute of image to the result/input File
			img.setAttribute('src', reader.result);
			//insertBefore as onload part gets executed after the outer code statements and we needed image above caption
			figure.insertBefore(img,figcap);			
		}*/
		reader.readAsDataURL(i)	
	}	
}


// classes('upload-btn')[0].addEventListener('click',()=>{
// 	classes('upload-dialog')[0].classList.remove('hide');
// 	classes('upload-dialog')[0].classList.add('display');
// });