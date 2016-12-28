(function () {
    var DATA = [
        ['<p style="color: #ccc;">时光飞逝，2016年迎来了尾声，2017年随之而来</p>', 0, 7, 0],
        ['<p style="color: #6cc;">iLibrary不知不觉已经度过4年时间了</p>', 0, 7, 5],
        ['<p style="color: #000;">祝各位小伙伴们在新的一年里</p>', 0, 7, 10],
        ['<p style="color: #3f6; font-size: 1em;">学习进步，心想事成</p>', 0, 7, 12],
        ['<p style="color: #ff0; font-size: 2em;">iLibrary Club</p>', 0, 7, 14],
        ['<p style="color: #cf6;">服务他人，提升自我</p>', 0, 5, 16],
        ['<p style="color: #f66;">新年快乐！</p>', 1, 3, 21],
        ['<p style="color: #6f6;">新年快乐！</p>', 1, 3, 21],
        ['<p style="color: #66f;">新年快乐！</p>', 1, 3, 21],
        ['<p style="color: #fc3;">新年快乐！</p>', 1, 3, 21],
        ['<p style="color: #3fc;">新年快乐！</p>', 1, 3, 21],
        ['<p style="color: #ff3; font-size: 1.5em;">Happy New Year!</p>', 2, 4, 23],
        ['<p style="color: #f3f; font-size: 1.5em;">Happy New Year!</p>', 2, 4, 23],
        ['<p style="color: #3ff; font-size: 1.5em;">Happy New Year!</p>', 2, 4, 23],
        ['<p style="color: #f66; font-size: 1.5em;">Happy New Year!</p>', 2, 4, 23],
        ['<img style="height: 3em;" src="pic/ilibrary.png">', 1, 5, 26],
        ['<img style="height: 3em;" src="pic/eeyes.png">', 2, 5, 27]
    ];
    var wrapper = document.getElementById('wrapper');
    var danmakuPainter = new DanmakuPainter(wrapper);
    // 窗口调整大小的时候调整大小
    (window.onresize = function () {
        wrapper.style.height = window.innerHeight + 'px';
        danmakuPainter.resize.bind(danmakuPainter)();
    })();
    for (var i = 0; i < DATA.length; ++i) {
        var div = document.createElement('div');
        div.innerHTML = DATA[i][0];
        (function (div, position, duration, delay) {
            setTimeout(function () {
                danmakuPainter.launch.bind(danmakuPainter)(new Danmaku(div, position, duration), 0);
            }, 1000 * delay);
        })(div, DATA[i][1], DATA[i][2], DATA[i][3]);
    }
    ;
})();