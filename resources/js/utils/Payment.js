export const loadScript = (callback) => {

    const script = document.createElement("script");
    script.src = "https://js.paystack.co/v1/inline.js";
    document.getElementsByTagName("head")[0].appendChild(script);
    if (script.readyState) {
        // IE
        script.onreadystatechange = () => {
            if (
                script.readyState === "loaded" ||
                script.readyState === "complete"
            ) {
                script.onreadystatechange = null;
                callback();
            }
        };
    } else {
        // Others
        script.onload = () => {
            callback();
        };
    }

    return script

}