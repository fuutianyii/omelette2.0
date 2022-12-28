/*
 * @Author: fuutianyii
 * @Date: 2022-12-28 12:42:27
 * @LastEditors: fuutianyii
 * @LastEditTime: 2022-12-28 18:17:54
 * @github: https://github.com/fuutianyii
 * @mail: fuutianyii@gmail.com
 * @QQ: 1587873181
 */
// var size = 86;
// var columns = Array.from(document.getElementsByClassName('column'));
// var d = void 0,
//     c = void 0;
// var classList = ['visible', 'close', 'far', 'far', 'distant', 'distant'];
// var use24HourClock = true;

// function padClock(p, n) {
// 	return p + ('0' + n).slice(-2);
// }

// function getClock() {
// 	d = new Date();
// 	return [use24HourClock ? d.getHours() : d.getHours() % 12 || 12, d.getMinutes(), d.getSeconds()].reduce(padClock, '');
// }

// function getClass(n, i2) {
// 	return classList.find(function (class_, classIndex) {
// 		return Math.abs(n - i2) === classIndex;
// 	}) || '';
// }

// var loop = setInterval(function () {
// 	c = getClock();

// 	columns.forEach(function (ele, i) {
// 		var n = +c[i];
// 		var offset = -n * size;
// 		ele.style.transform = 'translateY(calc(50vh + ' + offset + 'px - ' + size / 2 + 'px))';
// 		Array.from(ele.children).forEach(function (ele2, i2) {
// 			ele2.className = 'num ' + getClass(n, i2);
// 		});
// 	});
// }, 200 + Math.E * 10);

function changeBg() {
	var currentTime = new Date().getHours();
	if (7 <= currentTime&&currentTime < 17) {
		document.getElementsByClassName("container")[0].style.backgroundImage ="url('img/background_day.jpg')"
	}
	else {
		document.getElementsByClassName("container")[0].style.backgroundImage ="url('img/background_night.jpg')"
	}
}

changeBg();
setInterval(function(){ changeBg(); }, 300000); //300000 means 5 min