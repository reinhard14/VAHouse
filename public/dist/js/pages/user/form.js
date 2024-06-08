const submitAnswer = document.getElementById('submitAnswer');

submitAnswer.addEventListener('submit', function (e){
    e.preventDefault();
    handleAnswersForm(submitAnswer);
});
