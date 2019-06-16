const DUMMY_TEXT_200 = "adhesi afdal aktif aktivitas akuatik alarm ambulans amendemen amfibi amonia analisis andal antre apotek artefak subjek survei sutra swiss syahid syawal teknik teladan telepon tenteram termosfer tobat transpor triliun tripleks trofi umrah unta urgen urine ustaz utang kota yogyakarta	yudikatif zamrud mengapa pulau matahari menjadi bunga di ujung senja yang tidak bisa di ungkap dari alien dan mereka bisa saja pergi dari sini kemana saja saya tidak tahu, Karena amuba selalu mengikuti gajah yang bisa berguling di ufuk selama bujang hidup jomblo tetap merdeka, ketika mereka Indonesia menjadi Kasur haji seprei ketika mereka pergi kata acak menjadi sebuah kalimat dan saya tidak paham dengan apa yang saya ketik, saya mengerti. Apa yang membuat negara api menyerang karna avatar telah pergi dari kehidupannya, saya galau karna saya tidak bisa membaca rotasi bumi selama tujuh puluh tahun dan saya menyesal karna bumi berputar pada porosnya, mengapa anda bingung dengan kata saya, dan mengapa anda mengikuti perkataan saya di dalam hati padahal saya tidak menyuruh anda untuk melakukan itu hey tayo, tinder omegle youtube pewdiepie adalah seorang youtuber yang sedang balap subscribe dengan T-Series dan saya yakin yang akan menang adalah si ang sang avatar legendaris. Ketika saya mendengar sebuah lagu di ujung barat dan terdengar lah sebuah alunan biola di ujung utara saya langsung lari mengejar alunan biola tersebut dan ternyata setelah saya selidiki itu adalah sebuah alunan monyet yang sedang nyanyi berada di atas pohon jengkol."

const gamePlayPath = "http://localhost/befast/server/gamePlay.php"

let counter = document.getElementById("time-counter"),
type_text = document.getElementById("type-text"),
data_frame = document.getElementById("data-frame"),
player_id = document.getElementById("player_id"),
dataText = [],
index_text = 0,
playStatus = false,
timeOutPlay = null,
finishStatus = false,
clock = 60,
wpm = 0;

const setCounter = (current_counter) => {
    counter.textContent = ("0" + Math.floor((current_counter / 60))) + 
        ":" + 
        (Math.floor((current_counter % 60)) == 0 || (Math.floor((current_counter % 60)) < 10) 
        ? "0" + Math.floor((current_counter % 60)) : Math.floor((current_counter % 60)))
}

const getDataToDisplay = () => {
    dataText = DUMMY_TEXT_200.split(" ")
    data_frame.textContent = getDataRandom(dataText).join(" ")
    setCounter(clock)
}

const getDataRandom = (dataText) => {
    let temp = []
    for (let i = 0; i < 20; i++)
        temp.push(dataText[Math.floor(Math.random() * dataText.length)])
    return temp
}

const playTyping = (event) => {
    var code = event.which,
        spaceKey = 32;
    //If user press space key:
    if (!playStatus) {
        playStatus = true;
        timeOutPlay = setInterval(function() {
            clock--
            setCounter(clock)
            if (clock <= 0) {
                finishStatus = true
                clearInterval(timeOutPlay)
            }
        }, 1000)
    }
    if (finishStatus) {
        finishStatus = false
        let formData = new FormData()
        formData.append("action", "assesment")
        formData.append("player_id", player_id.value)
        formData.append("wpm", wpm)
        document.getElementById("loader").style.display = "block"
        ajax(formData, gamePlayPath, "POST", (response) => {
            console.log(response)
            if (response == 200) location.reload()
        })
        location.reload()
    }
    if (code == spaceKey) {
        let temp = data_frame.innerText.split(" ")
        if (temp[index_text] == type_text.value.trim()) {
            if (index_text < 19){
                temp[index_text] = "<span class='w3-text-deep-orange'>"+ temp[index_text] +"</span>"
                data_frame.innerHTML = temp.join(" ")
                type_text.value = ""
                index_text++
            }
            else {
                index_text = 0
                type_text.value = ""
                removeAllChild(data_frame)
                data_frame.innerHTML = getDataRandom(dataText).join(" ")
            }
            wpm++
        }
   }
}

const removeAllChild = (element) => {
    while(element.firstChild) {
        element.removeChild(element.firstChild)
    }
}