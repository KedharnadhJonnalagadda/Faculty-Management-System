<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

require_once "connect.php";
$fid = $_SESSION['FID'];

$sql = "select PROFILE FROM logins WHERE FID='$fid'";

$stmt = $conn->query($sql);
$stmt = $stmt->fetch();
?>
<div class="profileupdat-photo-div" id="profileupdat-photo-div">
    
        <div class="profileupdate-image-div" id="profileupdate-image-div" style="height: 250px;">
            <div id="loader"></div><img id="profileupdate-image" src="../assets/images/users/<?php echo $stmt['PROFILE']; ?>">
            <input id="x-position" type="range" name="x-position" value="0" min="0">
            <input id="y-position" type="range" name="y-position" value="0" min="0">
        </div>
        <div class="profile-profilebuttons-div">
            <div class="profileupdate-image-input" id="profileupdate-image-input">
                <label class="profilebutton" id="change-photo-label" for="change-photo">UPLOAD PHOTO</label>
                <i class="fa fa-exclamation-triangle" style="color:#ffcc00" aria-hidden="true">Croup Image Before Upload</i>
                <input id="change-photo" name="fileToUpload" type="file" style="display: none;" accept="image/*">
            </div>
            <div class="profileupdate-image-confirm" id="profileupdate-image-confirm" style="display: none;">
                <div class="profilebutton half green" id="save-img"><i class="fa fa" aria-hidden="true">Upload</i></div>
                <div class="profilebutton half red" id="cancel-img"><i class="fa fa" aria-hidden="true">Cancel</i></div>
            </div>
        </div>
    
</div>

<div class="error" id="error">min sizes 400*400px</div>
<canvas id="croppedPhoto" width="400" height="400"></canvas>

<script>
    var $profileImgDiv = document.getElementById("profileupdate-image-div"),
        $profileImg = document.getElementById("profileupdate-image"),
        $changePhoto = document.getElementById("change-photo"),
        $xPosition = document.getElementById("x-position"),
        $yPosition = document.getElementById("y-position"),
        $saveImg = document.getElementById("save-img"),
        $loader = document.getElementById("loader"),
        $cancelImg = document.getElementById("cancel-img"),
        $profileImgInput = document
        .getElementById("profileupdate-image-input"),
        $profileImgConfirm = document
        .getElementById("profileupdate-image-confirm"),
        $error = document.getElementById("error");

    var currentProfileImg = "",
        profileImgDivW = getSizes($profileImgDiv).elW,
        NewImgNatWidth = 0,
        NewImgNatHeight = 0,
        NewImgNatRatio = 0,
        NewImgWidth = 0,
        NewImgHeight = 0,
        NewImgRatio = 0,
        xCut = 0,
        yCut = 0;

    makeSquared($profileImgDiv);

    $changePhoto.addEventListener("change", function() {
        currentProfileImg = $profileImg.src;
        showPreview(this, $profileImg);
        $loader.style.width = "100%";
        $profileImgInput.style.display = "none";
        $profileImgConfirm.style.display = "flex";
        $error.style.display = "none";
    });

    $xPosition.addEventListener("input", function() {
        $profileImg.style.left = -this.value + "px";
        xCut = this.value;
        yCut = 0;
    });

    $yPosition.addEventListener("input", function() {
        $profileImg.style.top = -this.value + "px";
        yCut = this.value;
        xCut = 0;
    });

    $saveImg.addEventListener("click", function() {
        cropImg($profileImg);
        resetAll(true);
    });

    $cancelImg.addEventListener("click", function() {
        resetAll(false);
    });

    window.addEventListener("resize", function() {
        makeSquared($profileImgDiv);
        profileImgDivW = getSizes($profileImgDiv).elW;
    });

    function makeSquared(el) {
        var elW = el.clientWidth;
        el.style.height = elW + "px";
    }

    function showPreview(input, el) {
        var reader = new FileReader();
        reader.readAsDataURL(input.files[0]);
        if (input.files && input.files[0]) {
            reader.onload = function(e) {
                setTimeout(function() {
                    el.src = e.target.result;
                }, 300);

                var poll = setInterval(function() {
                    if (el.naturalWidth && el.src != currentProfileImg) {
                        clearInterval(poll);
                        setNewImgSizes(el);
                        setTimeout(function() {
                            $loader.style.width = "0%";
                            $profileImg.style.opacity = "1";
                        }, 1000);
                    }
                }, 100);
            };
        } else {
            return;
        }
    }

    function setNewImgSizes(el) {
        if (getNatSizes(el).elR > 1) {
            el.style.width = "auto";
            el.style.height = "100%";
            newImgWidth = getSizes(el).elW;
            $xPosition.style.display = "block";
            $yPosition.style.display = "none";
            $xPosition.max = newImgWidth - profileImgDivW;
        } else if (getNatSizes(el).elR < 1) {
            el.style.width = "100%";
            el.style.height = "auto";
            newImgHeight = getSizes(el).elH;
            $xPosition.style.display = "none";
            $yPosition.style.display = "block";
            $yPosition.max = newImgHeight - profileImgDivW;
        } else if (getNatSizes(el).elR == 1) {
            el.style.width = "100%";
            el.style.height = "100%";
            $xPosition.style.display = "none";
            $yPosition.style.display = "none";
        }
    }

    function getNatSizes(el) {
        var elW = el.naturalWidth,
            elH = el.naturalHeight,
            elR = elW / elH;
        return {
            elW: elW,
            elH: elH,
            elR: elR
        };
    }

    function getSizes(el) {
        var elW = el.clientWidth,
            elH = el.clientHeight,
            elR = elW / elH;
        return {
            elW: elW,
            elH: elH,
            elR: elR
        };
    }

    function cropImg(el) {
        var natClientImgRatio = getNatSizes(el).elW / getSizes(el).elW;
        (myCanvas = document.getElementById("croppedPhoto")),
        (ctx = myCanvas.getContext("2d"));
        ctx.fillStyle = "#ffffff";
        ctx.fillRect(0, 0, 400, 400);
        ctx.drawImage(
            el,
            xCut * natClientImgRatio,
            yCut * natClientImgRatio,
            profileImgDivW * natClientImgRatio,
            profileImgDivW * natClientImgRatio,
            0,
            0,
            400,
            400
        );
        var newProfileImgUrl = myCanvas.toDataURL("image/jpeg");
        $profileImg.src = newProfileImgUrl;

    }

    function resetAll(confirm) {
        if (!confirm) {
            $profileImg.src = currentProfileImg;
            init();


        }
        
        $profileImgInput.style.display = "none";
        $profileImgConfirm.style.display = "none";
        $profileImg.style.left = "0";
        $profileImg.style.top = "0";
        $profileImg.style.width = "100%";
        $profileImg.style.height = "100%";
        $xPosition.style.display = "none";
        $yPosition.style.display = "none";
        $xPosition.value = "0";
        $yPosition.value = "0";
        xCut = "0";
        yCut = "0";
        
    }

    function checkMinSizes(el) {
        if (getNatSizes(el).elW > 400 && getNatSizes(el).elH > 400) {
            return true;
        } else {
            return false;
        }
    }
</script>
<style type="text/css">
    body {
        margin: 0px;
        position: relative;
    }

    .bar {
        display: block;
        background-color: #00cccf;
    }

    .bar h1 {
        margin: 0px;
        font-family: helvetica, sans-serif;
        font-size: 22px;
        padding: 10px;
        color: white;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        font-weight: normal;
    }

    .profileupdat-photo-div {
        position: relative;
        margin: 50px auto 10px auto;
        width: 250px;
        height: auto;
        overflow: hidden;
        border-radius: 10px;
        -webkit-transition: ease .3s;
        -o-transition: ease .3s;
        transition: ease .3s;
    }

    .profileupdate-image-div {
        display: block;
        position: relative;
        overflow: hidden;
    }

    #loader {
        position: absolute;
        top: 0;
        left: 0;
        width: 0%;
        height: 100%;
        background-color: #00cccf;
        z-index: 10;
        -webkit-transition: .3s;
        -o-transition: .3s;
        transition: .3s;
    }

    #profileupdate-image {
        position: absolute;
        display: block;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    #change-photo {
        display: none;
    }

    .profile-profilebuttons-div {
        position: relative;
        display: block;
    }

    .profilebutton {
        position: relative;
        display: block;
        font-family: helvetica, sans-serif;
        font-size: 15px;
        padding: 20px;
        text-align: center;
        color: white;
        background-color: #00cccf;
        cursor: pointer;
        -webkit-transition: .5s;
        -o-transition: .5s;
        transition: .5s;
        overflow: hidden;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    .btnup{
        font-family: helvetica, sans-serif;
        font-size: 15px;
        color:white;
        text-align: center;
        border: none;
        
    }
    .profilebutton:hover,i:hover {
        letter-spacing: 1px;
        
        
    }

    .profilebutton:after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        width: 10px;
        height: 10px;
        background-color: rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        opacity: 0;
        -webkit-transition: .9s;
        -o-transition: .9s;
        transition: .9s;
    }

    .profilebutton:hover:after {
        -webkit-transform: scale(50);
        -ms-transform: scale(50);
        transform: scale(50);
        opacity: 1;
    }

    .profilebutton.half {
        width: 50%;
    }

    .green {
        background-color: #15ae6b;
    }

    .red {
        background-color: #ae0000;
    }

    #x-position {
        position: absolute;
        bottom: 5px;
        left: 50%;
        -webkit-transform: translateX(-50%);
        -ms-transform: translateX(-50%);
        transform: translateX(-50%);
        display: none;
    }

    #y-position {
        position: absolute;
        right: -50px;
        top: 50%;
        -webkit-transform: translateY(-50%) rotate(90deg);
        -ms-transform: translateY(-50%) rotate(90deg);
        transform: translateY(-50%) rotate(90deg);
        display: none;
    }

    canvas {
        position: fixed;
        top: -2000px;
        left: -2000px;
        z-index: -1;
    }

    .profileupdate-image-confirm {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        width: 100%;
    }

    .error {
        font-family: Helvetica, sans-serif;
        font-size: 13px;
        color: red;
        text-align: center;
        display: none;
    }
</style>