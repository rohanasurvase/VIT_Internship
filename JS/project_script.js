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
		//ids('display_file_name').innerText=i.name;
		let src= URL.createObjectURL(i);
		 ids('display_file_name').innerHTML+=`<a href="${src}" target="_blank">${i.name}</a><br>`;
		reader.readAsDataURL(i)	
	}	
}

