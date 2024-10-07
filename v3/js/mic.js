var speech_count = 0;
document.getElementById("start_recognition").onclick = function vr_function() {
    document.getElementById("mic_control").style.display = "block";
    var result_text = document.getElementById("result_text");
    while(result_text.firstChild) {
        result_text.removeChild(result_text.firstChild);
    }
    SpeechRecognition = webkitSpeechRecognition || SpeechRecognition;
    const recognition = new SpeechRecognition();
    recognition.lang = "ja-JP";
    recognition.interimResults = true;
    recognition.continuous = true;
    recognition.onresult = function(event) {
        var results = event.results;
        if(document.getElementById("interim_result") == null) {
            var interim = document.createElement("div");
            interim.setAttribute("class","results");
            interim.setAttribute("id","interim_result");
            document.getElementById("result_text").appendChild(interim);
        }
        for(var i = event.resultIndex; i < results.length; i++) {
            if(results[i].isFinal) {
                speech_count++;
                result_line = `<span>${results[i][0].transcript}</span>`;
                document.getElementById("interim_result").innerHTML = result_line;
                document.getElementById("interim_result").setAttribute("id","result" + speech_count);
                document.getElementById("search_param").setAttribute("value",results[i][0].transcript);
                document.googleform.submit();
                document.getElementById("status").innerHTML = "";
                recognition.stop();
                return;
            } else {
                document.getElementById("interim_result").innerHTML = `<span style="color:#999">${results[i][0].transcript}</span>`;
                flag_speech = 0;
            }
        }
    }
    document.getElementById("status").innerHTML = "聞き取っています...";
    recognition.start();
    document.getElementById("mic_stop1").addEventListener("click",function() {
        recognition.stop();
    });
    document.getElementById("mic_stop2").addEventListener("click",function() {
        recognition.stop();
        document.getElementById("status").innerHTML = `<span style="color:red">✖</span> 聞き取りを停止しました`;
    });
}
