const faqs = document.querySelectorAll(".preguntas");

faqs.forEach(preguntas => {
    preguntas.addEventListener("click", () =>{
        preguntas.classList.toggle("active");
    })
    
});