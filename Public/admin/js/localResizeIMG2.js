    /**
     * »ñµÃbase64
     * @param {Object} obj
     * @param {Number} [obj.width] Í¼Æ¬ÐèÒªÑ¹ËõµÄ¿í¶È£¬¸ß¶È»á¸úËæµ÷Õû
     * @param {Number} [obj.quality=0.8] Ñ¹ËõÖÊÁ¿£¬²»Ñ¹ËõÎª1
     * @param {Function} [obj.before(this, blob, file)] ´¦ÀíÇ°º¯Êý,thisÖ¸ÏòµÄÊÇinput:file
     * @param {Function} obj.success(obj) ´¦Àíºóº¯Êý
     * @example
     *
     */
    $.fn.localResizeIMG = function(obj) {
        this.on('change', function() {
            var file = this.files[0];
            var URL = window.URL || window.webkitURL;
            var blob = URL.createObjectURL(file);

            // Ö´ÐÐÇ°º¯Êý
            if ($.isFunction(obj.before)) {
                obj.before(this, blob, file)
            };

            _create(blob, file);
            this.value = ''; // Çå¿ÕÁÙÊ±Êý¾Ý
        });


        /**
         * Éú³Ébase64
         * @param blob Í¨¹ýfile»ñµÃµÄ¶þ½øÖÆ
         */
        function _create(blob) {
            var img = new Image();
            img.src = blob;

            img.onload = function() {
                var that = this;

                //Éú³É±ÈÀý
                var w = that.width,
                    h = that.height,
                    scale = w / h;
                w = obj.width || w;
                h = w / scale;

                //Éú³Écanvas
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');
                $(canvas).attr({
                    width: w,
                    height: h
                });
                ctx.drawImage(that, 0, 0, w, h);

                /**
                 * Éú³Ébase64
                 * ¼æÈÝÐÞ¸´ÒÆ¶¯Éè±¸ÐèÒªÒýÈëmobileBUGFix.js
                 */
                var base64 = canvas.toDataURL('image/jpeg', obj.quality || 0.8);

                // ÐÞ¸´IOS
                if (navigator.userAgent.match(/iphone/i)) {
                    var mpImg = new MegaPixImage(img);
                    mpImg.render(canvas, {
                        maxWidth: w,
                        maxHeight: h,
                        quality: obj.quality || 0.8
                    });
                    base64 = canvas.toDataURL('image/jpeg', obj.quality || 0.8);
                }

                // ÐÞ¸´android
                if (navigator.userAgent.match(/Android/i)) {
                    var encoder = new JPEGEncoder();
                    base64 = encoder.encode(ctx.getImageData(0, 0, w, h), obj.quality * 100 || 80);
                }

                // Éú³É½á¹û
                var result = {
                    base64: base64,
                    clearBase64: base64.substr(base64.indexOf(',') + 1)
                };

                // Ö´ÐÐºóº¯Êý
                obj.success(result);
            };
        }
    };


    // Àý×Ó
    /*
    $('input:file').localResizeIMG({
        width: 100,
        quality: 0.1,
        //before: function (that, blob) {},
        success: function (result) {
            var img = new Image();
            img.src = result.base64;

            $('body').append(img);
            console.log(result);
        }
    });
*/