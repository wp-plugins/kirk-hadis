<?php
/*
Plugin Name: Kırk Hadis
Plugin URI: http://wordpress.org/extend/plugins/kirk-hadis/
Description: Bu eklenti, Türkiye Cumhuriyeti Diyanet İşleri Başkanlığı resmi internet sitesinden alınan 40 hadisi, rastgele bir şekilde ziyaretçilerinize göstermektedir.
Version: 1.0
Author: Süleyman ÜSTÜN
Author URI: http://suleymanustun.com
*/

add_action("plugins_loaded", "kh_widget_create");
function kh_widget_create() {
	$options = array('classname' => 'kh_widget', 'description' => "Türkiye Cumhuriyeti Diyanet İşleri Başkanlığı resmi internet sitesinden alınan 40 hadisi, rastgele bir şekilde ziyaretçilerinize gösterir." );
	wp_register_sidebar_widget('kh_widget', 'Kırk Hadis', 'kh_widget_init', $options);
}

function kh_widget_init($args) {
	extract($args);
	echo $before_widget;
	echo $before_title.'Kırk Hadis'.$after_title;
	kh_widget_show();
	echo $after_widget;
}

function kh_widget_show() {
	$turkce = array(
		'(Allah Rasûlü) “Din nasihattır/samimiyettir” buyurdu. “Kime Yâ Rasûlallah?” diye sorduk. O da; “Allah’a, Kitabına, Peygamberine, Müslümanların yöneticilerine ve bütün müslümanlara” diye cevap verdi. <p style="text-align:right"><i>Müslim, İmân, 95.</i></p>',
		'İslâm, güzel ahlâktır. <p style="text-align:right"><i>Kenzü’l-Ummâl, 3/17, HadisNo: 5225</i></p>',
		'İnsanlara merhamet etmeyene Allah merhamet etmez. <p style="text-align:right"><i>Müslim, Fedâil, 66; Tirmizî, Birr, 16</i></p>',
		'Kolaylaştırınız, güçleştirmeyiniz, müjdeleyiniz, nefret ettirmeyiniz. <p style="text-align:right"><i>Buhârî, İlm, 12; Müslim, Cihâd, 6.</i></p>',
		'İnsanların Peygamberlerden öğrenegeldikleri sözlerden biri de: “Utanmadıktan sonra dilediğini yap!” sözüdür. <p style="text-align:right"><i>Buhârî, Enbiyâ, 54; EbuDâvûd, Edeb, 6.</i></p>',
		'Hayra vesile olan, hayrı yapan gibidir. <p style="text-align:right"><i>Tirmizî, İlm, 14.</i></p>',
		'Mümin, bir  delikten iki defa sokulmaz. (Mümin, iki defa aynı yanılgıya düşmez.) <p style="text-align:right"><i>Buhârî, Edeb, 83; Müslim, Zühd, 63.</i></p>',
		'Nerede olursan ol Allah’a karşı gelmekten sakın; yaptığın kötülüğün arkasından bir iyilik yap ki bu onu yok etsin. İnsanlara karşı güzel ahlakın gereğine göre davran. <p style="text-align:right"><i>Tirmizî, Birr, 55.</i></p>',
		'Allah, sizden birinizin yaptığı işi, ameli ve görevi  sağlam ve iyi yapmasından hoşnut olur. <p style="text-align:right"><i>Taberânî, el-Mu’cemü’l-Evsat, 1/275; Beyhakî, ﬁu’abü’l-Îmân, 4/334.</i></p>',
		'İman, yetmiş küsur derecedir. En üstünü “Lâ ilâhe illallah (Allah’tan başka ilah yoktur)” sözüdür, en düşük derecesi de rahatsız edici bir şeyi yoldan kaldırmaktır. Haya da imandandır. <p style="text-align:right"><i>Buhârî, Îmân, 3; Müslim, Îmân, 57, 58</i></p>',
		'Kim kötü ve çirkin bir iş görürse onu eliyle düzeltsin; eğer buna gücü yetmiyorsa diliyle düzeltsin; buna da gücü yetmezse, kalben karşı koysun. Bu da imanın en zayıf derecesidir. <p style="text-align:right"><i>Müslim, Îmân, 78; Ebû Dâvûd, Salât, 248.</i></p>',
		'İki göz vardır ki, cehennem ateşi onlara dokunmaz: Allah korkusundan ağlayan göz, bir de gecesini Allah yolunda, nöbet tutarak geçiren göz. <p style="text-align:right"><i>Tirmizî, Fedâilü’l-Cihâd, 12.</i></p>',
		'Zarar vermek ve zarara zararla karşılık vermek yoktur. <p style="text-align:right"><i>İbn Mâce, Ahkâm, 17; Muvatta’, Akdıye, 31.</i></p>',
		'Hiçbiriniz kendisi için istediğini (mü’min) kardeşi için istemedikçe (gerçek) iman etmiş olamaz. <p style="text-align:right"><i>Buhârî, Îmân, 7; Müslim, Îmân, 71.</i></p>',
		'Müslüman müslümanın kardeşidir. Ona zulmetmez, onu (düşmanına) teslim etmez. Kim, (mümin) kardeşinin bir ihtiyacını giderirse Allah da onun bir ihtiyacını giderir. Kim müslümanı bir sıkıntıdan kurtarırsa, bu sebeple Allah da onu kıyamet günü sıkıntılarının birinden kurtarır.  Kim bir müslümanı(n kusurunu) örterse, Allah da Kıyamet günü onu(n  kusurunu) örter. <p style="text-align:right"><i>Buhârî, Mezâlim, 3; Müslim, Birr, 58.</i></p>',
		'İman etmedikçe cennete giremezsiniz, birbirinizi sevmedikçe de (gerçek anlamda) iman etmiş olamazsınız. <p style="text-align:right"><i>Müslim, Îmân, 93; Tirmizî, Sıfâtu’l-Kıyâme, 56.</i></p>',
		'Müslüman, insanların elinden ve dilinden emin olduğu kimsedir. <p style="text-align:right"><i>Tirmizî, Îmân, 12; Nesâî, Îmân, 8.</i></p>',
		'Birbirinize buğuz etmeyin, birbirinize haset etmeyin, birbirinize arka çevirmeyin; ey Allah’ın kulları, kardeş olun. Bir müslümana, üç günden fazla (din) kardeşi ile dargın durması helal olmaz. <p style="text-align:right"><i>Buhârî, Edeb, 57, 58.</i></p>',
		'Hiç şüphe yok ki doğruluk iyiliğe götürür. İyilik de cennete götürür. Kişi doğru söyleye söyleye Allah katında sıddîk (doğru sözlü) diye yazılır. Yalancılık kötüye götürür. Kötülük de cehenneme götürür. Kişi yalan söyleye söyleye Allah katında kezzâb (çok yalancı) diye yazılır. <p style="text-align:right"><i>Buhârî, Edeb, 69; Müslim, Birr, 103, 104.</i></p>',
		'(Mümin) kardeşinle münakaşa etme, onun hoşuna gitmeyecek şakalar yapma ve ona yerine getirmeyeceğin bir söz verme. <p style="text-align:right"><i>Tirmizî, Birr, 58.</i></p>',
		'(Mümin) kardeşine tebessüm etmen sadakadır. İyiliği emredip kötülükten sakındırman sadakadır. Yolunu kaybeden kimseye yol göstermen sadakadır. Yoldan taş, diken, kemik gibi şeyleri kaldırıp atman da senin için sadakadır. <p style="text-align:right"><i>Tirmizî, Birr, 36.</i></p>',
		'Allah sizin ne dış görünüşünüze ne de mallarınıza bakar. Ama o sizin kalplerinize ve işlerinize bakar. <p style="text-align:right"><i>Müslim, Birr, 33; İbn Mâce, Zühd, 9; Ahmed b. Hanbel, 2/285, 539.</i></p>',
		'Allah’ın rızası, anne ve babanın rızasındadır. Allah’ın öfkesi de anne babanın öfkesindedir. <p style="text-align:right"><i>Tirmizî, Birr, 3.</i></p>',
		'Üç dua vardır ki, bunlar şüphesiz kabul edilir: Mazlumun duası, yolcunun duası ve babanın evladına duası. <p style="text-align:right"><i>İbn Mâce, Dua, 11.</i></p>',
		'Hiçbir baba, çocuğuna, güzel terbiyeden daha üstün bir hediye veremez. <p style="text-align:right"><i>Tirmizî, Birr, 33.</i></p>',
		'Sizin en hayırlılarınız, hanımlarına karşı en iyi davrananlarınızdır. <p style="text-align:right"><i>Tirmizî, Radâ’, 11; ‹bn Mâce, Nikâh, 50.</i></p>',
		'Küçüklerimize merhamet etmeyen, büyüklerimize saygı göstermeyen bizden değildir. <p style="text-align:right"><i>Tirmizî, Birr, 15; Ebû Dâvûd, Edeb, 66.</i></p>',
		'Peygamberimiz işaret parmağı ve orta parmağıyla işaret ederek: “Gerek kendisine ve gerekse başkasına ait herhangi bir yetimi görüp gözetmeyi üzerine alan kimse ile ben, cennette işte böyle yanyanayız” buyurmuştur. <p style="text-align:right"><i>Buhârî, Talâk, 25, Edeb, 24; Müslim, Zühd, 42.</i></p>',
		'(İnsanı) helâk eden şu yedi şeyden kaçının. Onlar nelerdir ya Resulullah dediler. Bunun üzerine: Allah’a şirk koşmak, sihir, Allah’ın haram kıldığı cana kıymak, faiz yemek, yetim malı yemek, savaştan kaçmak, suçsuz ve namuslu mümin kadınlara iftirada bulunmak buyurdu. <p style="text-align:right"><i>Buhârî, Vasâyâ, 23, Tıbb, 48; Müslim, Îmân, 144.</i></p>',
		'Allah’a ve ahiret gününe imân eden kimse, komşusuna eziyet etmesin. Allah’a ve ahiret gününe imân eden misafirine ikramda bulunsun. Allah’a ve ahiret gününe imân eden kimse, ya hayır söylesin veya sussun. <p style="text-align:right"><i>Buhârî, Edeb, 31, 85; Müslim, Îmân, 74, 75.</i></p>',
		'Cebrâil bana komşu hakkında o kadar çok tavsiyede bulundu ki; ben (Allah Teâlâ) komşuyu komşuya mirasçı kılacak zannettim. <p style="text-align:right"><i>Buhârî, Edeb, 28; Müslim, Birr, 140, 141.</i></p>',
		'Dul ve fakirlere yardım eden kimse, Allah yolunda cihad eden veya gündüzleri (nafile) oruç tutup, gecelerini (nafile) ibadetle geçiren kimse gibidir. <p style="text-align:right"><i>Buhârî, Nafakât, 1; Müslim, Zühd, 41; Tirmizî, Birr, 44; Nesâî, Zekât, 78.</i></p>',
		'Her insan hata eder. Hata işleyenlerin en hayırlıları tevbe edenlerdir. <p style="text-align:right"><i>Tirmizî, Kıyâme, 49; İbn Mâce, Zühd, 30.</i></p>',
		'Mü’minin başka hiç kimsede bulunmayan ilginç bir hali vardır; O’nun her işi hayırdır. Eğer bir genişliğe (nimete) kavuşursa şükreder ve bu onun için bir hayır olur. Eğer bir  darlığa (musibete) uğrarsa sabreder ve bu da onun için bir hayır olur. <p style="text-align:right"><i>Müslim, Zühd, 64; Dârim”, Rikâk, 61.</i></p>',
		'Bizi aldatan bizden değildir. <p style="text-align:right"><i>Müslim, Îmân, 164.</i></p>',
		'Söz taşıyanlar (cezalarını çekmeden ya da affedilmedikçe) cennete giremezler. <p style="text-align:right"><i>Müslim, Îmân, 168; Tirmizî, Birr, 79.</i></p>',
		'İşçiye ücretini, (alnının) teri kurumadan veriniz. <p style="text-align:right"><i>İbn Mâce, Ruhûn, 4.</i></p>',
		'Bir müslümanın diktiği ağaçtan veya ektiği ekinden insan, hayvan ve kuşların yedikleri şeyler, o müslüman için birer sadakadır. <p style="text-align:right"><i>Buhârî, Edeb, 27; Müslim, Müsâkât, 7, 10.</i></p>',
		'İnsanda bir organ vardır. Eğer o sağlıklı ise bütün vücut sağlıklı olur; eğer o bozulursa bütün vücut bozulur. Dikkat edin! O, kalptir. <p style="text-align:right"><i>Buhârî, Îmân, 39; Müslim, Müsâkât, 107.</i></p>',
		'Rabbinize karşı gelmekten sakının, beş vakit namazınızı kılın, Ramazan orucunuzu tutun, mallarınızın zekatını verin, yöneticilerinize itaat edin. (Böylelikle) Rabbinizin cennetine girersiniz. <p style="text-align:right"><i>Tirmizî, Cum’a, 80.</i></p>'
	);
	echo '<p>'.$turkce[array_rand($turkce)].'</p>';
}
?>