<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
      <meta name="generator" content="Jekyll v3.8.5">
      <title>AvenueMontaigne</title>
     

<style>
   :root {
    --real100vh: 100vh;
}
body {
    font-family: Pilat, sans-serif;
    font-size: 16px;
    color: #000;
    background-color: #fff;
    margin: 0;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-feature-settings: "kern" 1, "kern";
    -webkit-font-kerning: normal;
    font-kerning: normal;
}
::-moz-selection {
    color: #000;
    background: #fff;
}
::selection {
    color: #000;
    background: #fff;
}
::-webkit-scrollbar {
    display: none;
}
h1,
h2,
h3,
h4,
h5 {
    font-weight: 400;
}
a {
    text-decoration: none;
    color: inherit;
    transition: color 0.4s;
}
button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border: none;
    background-color: transparent;
    cursor: pointer;
    outline: none;
    margin: 0;
}
.title .line {
    display: block;
}
.overlay {
    position: absolute;
    bottom: 0;
    right: 0;
    left: 0;
    top: 0;
    background: rgba(0, 0, 0, 0.3);
}
.main {
    z-index: 100;
}
.site-footer {
    z-index: 200;
}
.gallery-slider {
    z-index: 300;
}
.menu-navigation-tabs {
    z-index: 400;
}
.section-home {
    z-index: 500;
}
.site-header {
    z-index: 600;
}
.panel-main-menu {
    z-index: 1000;
}
.site-hamburger {
    z-index: 1100;
}
@-webkit-keyframes bounce {
    0%,
    20%,
    50%,
    80%,
    to {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(3px);
    }
}
@keyframes bounce {
    0%,
    20%,
    50%,
    80%,
    to {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(3px);
    }
}
:root {
    --real100vh: 100vh;
}

@font-face {
    font-family: Pilat;
    src: url(/fonts/Pilat-Regular.woff2) format("woff2"), url(/fonts/Pilat-Regular.woff) format("woff");
    font-style: normal;
    font-weight: 400;
}
@font-face {
    font-family: Pilat;
    src: url(/fonts/Pilat-Demi.woff2) format("woff2"), url(/fonts/Pilat-Demi.woff) format("woff");
    font-style: normal;
    font-weight: 600;
}
@font-face {
    font-family: Pilat-Extended;
    src: url(/fonts/PilatExtended-Regular.woff2) format("woff2"), url(/fonts/PilatExtended-Regular.woff) format("woff");
    font-style: normal;
    font-weight: 400;
}
@font-face {
    font-family: Pilat-Extended;
    src: url(/fonts/PilatExtended-Book.woff2) format("woff2"), url(/fonts/PilatExtended-Book.woff) format("woff");
    font-style: normal;
    font-weight: 500;
}
@font-face {
    font-family: Pilat-Extended;
    src: url(/fonts/PilatExtended-Bold.woff2) format("woff2"), url(/fonts/PilatExtended-Bold.woff) format("woff");
    font-style: normal;
    font-weight: 700;
}
@font-face {
    font-family: Pilat-Extended;
    src: url(/fonts/PilatExtended-Black.woff2) format("woff2"), url(/fonts/PilatExtended-Black.woff) format("woff");
    font-style: normal;
    font-weight: 900;
}

:root {
    --real100vh: 100vh;
}
.container-layout {
    background-color: #fff;
    position: relative;
    overflow: hidden;
}
.container-layout #tagline {
    display: none;
}
:root {
    --real100vh: 100vh;
}
.menu-navigation-tabs {
    position: relative;
}
.menu-navigation-tabs .column {
    position: fixed;
}
.menu-navigation-tabs .left {
    left: 0;
    top: 0;
    height: 80px;
    transform: rotate(90deg);
    transform-origin: left bottom;
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-start;
    align-content: center;
    align-items: center;
}
.menu-navigation-tabs .left .link {
    margin-right: 30px;
}
.menu-navigation-tabs .left.white-text .link {
    color: #fff;
}
.menu-navigation-tabs .right {
    right: 0;
    bottom: 0;
    height: 80px;
    transform: rotate(90deg);
    transform-origin: right top;
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: flex-end;
    align-content: center;
    align-items: center;
}
.menu-navigation-tabs .right .link {
    margin-left: 30px;
    color: #a0a0a0;
    letter-spacing: 2px;
}
.menu-navigation-tabs .right.hide .link {
    display: none;
}
.menu-navigation-tabs .link {
    color: #000;
    display: inline-block;
    font-family: Pilat-Extended, sans-serif;
    font-weight: 900;
    font-size: 14px;
    text-transform: uppercase;
}
@media only screen and (max-width: 750px) {
    .menu-navigation-tabs .left {
        height: 40px;
        padding-left: 30px;
    }
    .menu-navigation-tabs .right {
        height: 40px;
    }
    .menu-navigation-tabs .link {
        font-size: 12px;
    }
}
:root {
    --real100vh: 100vh;
}
.site-header {
    position: fixed;
    width: 100%;
    height: 80px;
    mix-blend-mode: difference;
}
.site-header .logo {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
:root {
    --real100vh: 100vh;
}
.slide-left-enter {
    transform: translateX(100%);
}
.slide-left-enter-to {
    transform: translateX(0);
}
.slide-left-enter-active .slide-left-leave-active .slide-right-enter-active .slide-right-leave-active {
    transition: all 0.3s;
}
.slide-left-leave-to {
    transform: translateX(100%);
}
.slide-right-enter,
.slide-right-leave-to {
    transform: translateX(-100%);
}
:root {
    --real100vh: 100vh;
}
.site-hamburger {
    height: 20px;
    width: 20px;
    padding: 20px;
    position: fixed;
    top: 5px;
    right: 16px;
    cursor: pointer;
}
.site-hamburger .button {
    width: 30px;
    height: 6px;
    background-color: #000;
    margin-top: 10px;
    transition: all 0.3s ease-in-out;
}
.site-hamburger .button.square {
    height: 30px;
}
.site-hamburger.white-icon .button {
    background-color: #fff;
}
@media only screen and (max-width: 750px) {
    .site-hamburger {
        height: 15px;
        width: auto;
        padding: 5px;
        top: 15px;
        right: 7px;
    }
    .site-hamburger .button {
        width: 15px;
    }
    .site-hamburger .button.square {
        height: 15px;
    }
}
:root {
    --real100vh: 100vh;
}
.section-home {
    color: #000;
    margin: 0 auto;
    min-height: 100vh;
    min-height: var(--real100vh);
    transition: height 0.2s ease-in-out;
    width: 100%;
    text-align: center;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    align-content: center;
    align-items: center;
    font-family: Pilat-Extended, sans-serif;
    z-index: 0;
}
.section-home .block {
    width: 50%;
    height: 100vh;
    height: var(--real100vh);
    position: relative;
    z-index: 10;
}
.section-home .block .tagline {
    position: absolute;
    top: 3%;
    left: 50%;
    transform: translate(-50%, -5%);
    z-index: 630;
    color: #fff;
    font-size: 3.5vw;
    font-family: Pilat-Extended, sans-serif;
    font-weight: 900;
    text-transform: uppercase;
    white-space: nowrap;
}
.section-home .block .image {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
.section-home .block:last-of-type .tagline {
    top: auto;
    bottom: 3%;
}
.section-home .logo {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 630;
    width: 87%;
    height: auto;
    pointer-events: none;
    fill: #fff;
}
@media only screen and (max-width: 1024px) {
    .section-home {
        flex-direction: column;
    }
    .section-home .block {
        width: 100%;
        height: 50vh;
        height: calc(var(--real100vh) / 2);
    }
    .section-home .block .tagline {
        font-size: 5vw;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .section-home .block:last-of-type .tagline {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        bottom: auto;
    }
}
:root {
    --real100vh: 100vh;
}
.responsive-image {
    background-color: #000;
}
.responsive-image .sizer {
    position: relative;
}
.responsive-image .media {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    transition: opacity 0.4s ease-in-out;
    z-index: 10;
}
.responsive-image .video {
    z-index: 20;
}
.responsive-image.mode-intrinsic-ratio {
    position: relative;
}
.responsive-image.mode-fullbleed .sizer {
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    position: absolute;
}
.responsive-image.has-error .media,
.responsive-image.has-loaded .media {
    opacity: 1;
}
.responsive-image.has-error.has-image-error .image,
.responsive-image.has-error.has-video-error .video {
    opacity: 0;
}

</style>
   </head>
   <body>
      <div id="">
            <main id="main" class="container-layout main breakpoint-desktop route-index">
                <div class="site-header">
                    <a href="/" aria-current="page" class="logo exact-active-link active-link link-prefetched">
                       <img src="http://am.test/images/logo/avenue_montaigne.jpeg" alt="" srcset="">
                    </a>
                </div>
                
                <section class="section section-home">
                    <a href=".test" class="block left link-prefetched">
                        <div class="image responsive-image mode-fullbleed has-loaded" style="">
                            <div class="sizer">
                                <video src="https://player.vimeo.com/external/387033185.hd.mp4?s=0474dd8d7f5e8f84f7fcb652be46e0b2870a4705&amp;profile_id=175" poster="" loop="loop" playsinline="true" muted="muted" class="media video" style="object-fit:cover;"></video>
                            </div>
                        </div>
                        <h2 class="tagline">Advertising</h2>
                    </a>
                    <a href="http://myshortlet.test/"  target="_blank" class="block left link-prefetched">
                        <div class="image responsive-image mode-fullbleed has-loaded" style="">
                            <div class="sizer">
                                <!----> 
                                <video src="https://player.vimeo.com/external/387033215.hd.mp4?s=12be46f4de65bc2112f71e51d35de68b06d7cc1a&amp;profile_id=175" poster="" loop="loop" playsinline="true" muted="muted" class="media video" style="object-fit:cover;"></video>
                            </div>
                        </div>
                        <h2 class="tagline">Music Videos </h2>
                    </a>
                </section>
            </main>
            
      </div>
   </body>
</html>