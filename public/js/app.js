const root = document.documentElement;
 
document.addEventListener('mousemove', evt => {
    let x = evt.clientX / innerWidth;
    let y = evt.clientY / innerHeight;
 
    root.style.setProperty('--mouse-x', x);
    root.style.setProperty('--mouse-y', y);
});


function changeCheckbox(id){        
    var checkbox = document.getElementById(id);
    if(checkbox.checked == true){
        checkbox.checked = false;
    }else{
        checkbox.checked = true;
    }
}
