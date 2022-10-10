
window.addEventListener("DOMContentLoaded", function () {
    function setParams(e) {
      const img = e.target || e;
      img.setAttribute("width", img.width);
      img.setAttribute("height", img.height);
    }
  
    function processFile(image) {
      const file = image.src;
      setParams(image);
      new Promise(function (resolve, reject) {
        let rawImage = new Image();
  
        rawImage.addEventListener("load", function () {
          resolve(rawImage);
        });
  
        rawImage.src = file;
      })
        .then(function (rawImage) {
          return new Promise(function (resolve, reject) {
            let canvas = document.createElement("canvas");
            let ctx = canvas.getContext("2d");
  
            canvas.width = rawImage.width;
            canvas.height = rawImage.height;
            ctx.drawImage(rawImage, 0, 0);
            canvas.toBlob(function (blob) {
              resolve(URL.createObjectURL(blob));
            }, "image/webp");
          });
        })
        .then(function (newUrl) {
          image.src = newUrl;
        });
    }
  
    window.setTimeout(function () {
      const images = document.querySelectorAll("img");
      for (let i = 0; i < images.length; i++) {
        processFile(images[i]);
        images[i].onload = setParams;
      }
    }, 1);
  });
  
  window.addEventListener("DOMContentLoaded", function () {
    function setParams(e) {
      const img = e.target || e;
      img.setAttribute("width", img.width);
      img.setAttribute("height", img.height);
    }
    window.setTimeout(function () {
      const images = document.querySelectorAll("img");
      for (let i = 0; i < images.length; i++) {
        setParams(images[i]);
        images[i].onload = setParams; 
      }
    }, 1);
  });
  