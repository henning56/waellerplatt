<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HirtenfestController extends Controller
{
    public function index()
    {
        $verses = [
            [
                'audio' => '1.mp3',
                'dialect' => 'Aich mecht hej koa gruß Reed hall,<br>aich schinejern maich e\' bissche vier de Leu all,<br>drim hu aich alles geschriwwe off en Zill,<br>doa zoum auswennich lern er es mir ze vill.',
                'translation' => 'Ich möchte heute keine große Rede halten,<br>ich schäme mich etwas vor all den Leuten,<br>drum habe ich alles auf einen Zettel geschrieben,<br>denn zum auswendig sagen ist es mir zu viel.'
            ],
            [
                'audio' => '2.mp3', 
                'dialect' => 'Sonst hu mir Waibsleu joa net vill ze soa,<br>besonnersch net en Sache vo d\'r Gemoa,<br>do soa de Mannsleu: "Dej un de Kenn<br>hu hej naut ze schwetze dren!"<br>Owwer hau sai m\'r wohl all zesohme<br>zoum Hörtefest vom Schulipatt komme,<br>do deffe mir Weibsleu aach mohl woas soa,<br>sugoar en Sache vo d\'r Gemoah.',
                'translation' => 'Sonst haben wir Frauen ja nicht viel zu sagen,<br>besonders nicht in Sachen der Gemeinde,<br>da sagen die Männer: "Frauen und Kinder<br>sollen hier nicht dreinreden!"<br>Aber heute sind wir alle zusammen<br>zum Hirtenfest vom Schulipatt gekommen,<br>da dürfen die Frauen auch mal was sagen,<br>sogar in Sachen der Gemeinde.'
            ],
            [
                'audio' => '3.mp3',
                'dialect' => 'Do fier de Gemoa hoat foffzig Juhr,<br>dinkt auch mohl, worr\' en lang Dur,<br>Schulipatt des Vej gehout,<br>aich glawe net, dess des mancher dout.<br>Su en ganze Doag off d\'r Vejwaa ze stieh,<br>wu keeme mir do mit uus Nerve hie.<br>Mitinner hoat m\'r aach halsstarrig Vej,<br>des gitt \'em Willhelm durch,<br>doa horr\' es noch net gesej.',
                'translation' => 'Für die Gemeinde hat fünfzig Jahre,<br>denkt einmal, welch lange Zeit,<br>Schulipatt das Vieh gehütet.<br>Ich glaube nicht, dass viele das tun.<br>Einen ganzen Tag auf der Viehweide zu stehen,<br>wo käme man da mit den Nerven hin.<br>Machmal hat man halsstarriges Vieh,<br>das geht dem Wilhelm durch,<br>kaum hat er sich\'s versehn.'
            ],
            [
                'audio' => '4.mp3',
                'dialect' => 'D\'r Hond, der hört en aach net immer,<br>un mecht de Sach noch vill schlimmer,<br>er jeht des Vejh, Hals üwwer Kopp,<br>oafach stracks de Vejwaa noab;<br>Schulipatt kimmt doa henner drenn,<br>er kann se owwer net mie halle en.<br>Do gitt\'s glaich wör de Vejwaa noff,<br>\'s Anna un de Alfred schloh doa droff.',
                'translation' => 'Der Hund, der hört auch nicht immer,<br>und macht die Sache noch viel schlimmer.<br>Er jagt das Vieh, Hals über Kopf.<br>einfach die Vieweide hinunter.<br>Schulipatt läuft hinterdrein,<br>er kan sie nicht merh halten ein.<br>Dann geht es wieder die Wiehweide rauf,<br>Anna und Alfred schlagen drauf.'
            ],
            [
                'audio' => '5.mp3',
                'dialect' => 'Em Sommer, wenn\'s off d\'r Vejwaa es goar trocke,<br>un des Vej find noch net mohl en saftige Brocke,<br>doa will de Herd mit aller Gewaalt<br>oafach nüwwer en de Waald.<br>De Schoof sai schuh lang nammie debai,<br>dej laie em Distrikt zwo owwer drai,<br>den Herrn vo de Förschderai mecht aich hejmit saa,<br>nemmt\'s doch mit em Wilhelm net su genaa.<br>Wenn ihr em Waald fend poar Schoof owwer en Kou,<br>drickt doch emoal baare Aache zou!',
                'translation' => 'Im Sommer, wenn\'s auf der Viehweide ist gar trocken,<br>und das Vieh findet nicht einen saftigen Brocken,<br>da will die Herde mit aller Gewalt,<br>einfach hinüber in den Wald.<br>Die Schafe sind schon lange nicht mehr dabei.<br>Sie liegen im Distrikt zwei oder drei.<br>Den Herren von der Försterei möchte ich sagen,<br>nehmt es mit dem Wilhelm nicht so genau,<br>wenn ihr im Wald findet Schaf oder Kuh,<br>drückt einmal beide Augen zu.'
            ],
            [
                'audio' => '6.mp3',
                'dialect' => 'Schulipatt woar em Sonneschai un Roa<br>mastens m\'r em Vej allo off d\'r Waa.<br>Es woar em Juhr 27, dou koom e\' en e\' Gewö\'ör,<br>dou schlugg de Blitz em zwoo Keu nö\'ör.<br>Er loag bedäubt dou ganz do oowe,<br>im en rim deht es ganz förchterlich toowe.<br>Em Hörbst, wenn\'s kaalt wörd, örr es aach net schie,<br>em Wend un We\'er bai d\'r Vejherd ze stieh.',
                'translation' => 'Schulipatt war bei Sonnenschein und Regen,<br>meistens mit dem Vieh auf der Weide.<br>Es war im Jahre 27, da kam ein Gewitter,<br>da schlug ihm der Blitz zwei Kühe nieder.<br>Er lag betäubt da ganz da oben,<br>um ihn rum war es furchtbar am toben.<br>Im Herbst, wenn\'s kalt wird, ist es auch nicht schön,<br>bei Wind und Wetter bei der Viehherde zu stehen.'
            ],
            [
                'audio' => '7.mp3',
                'dialect' => 'Su hoatt em Lääwe alles sai zwo Saire,<br>Schulipatt kann de Gaaße net laire,<br>Er seeht: "M\'r hott sai Last mit dem langhuhrige Vej,<br>dej sai su neuschierig un schnibbich wej de Waibsleu!"<br>Dej Schoof dogeeje horr\'e recht gern,<br>dej doure em Sommer fai scheern.<br>En freuere Zaire dere se wösche en d\'r Dill<br>dou tronke gemoanerhand poar Schnäps\'cher zevill.',
                'translation' => 'So hat im Leben alles seine zwei Seiten,<br>Schulipatt kann die Ziegen nicht leiden.<br>Er sagt: "Man hat seine Last mit dem langhaarigen Vieh,<br>es ist so neugierig und schnippisch wie die Frauen!"<br>Die Schafe dagegen hat er recht gern,<br>die tut er im Sommer fein scheeren.<br>In früherer Zeit hat er sie gewaschen in der Dill,<br>dann trank er ein paar Schnäpschen zuviel.'
            ],
            [
                'audio' => '8.mp3',
                'dialect' => 'Wej des su Muhre es, rim en dim,<br>gitt de Kouhört zoum Esse off d\'r Raih rim.<br>Baim Schulipatt brauch m\'r net ze hall vill Kocherai,<br>eer isst oom lejbsde soiße Brai.<br>Doch wej e\' wohl finf Doag nohnoa Brai musst esse,<br>dou saar\'e: "Its will aich naut mih dovo wesse.<br>Aich esse ganz gern e\' Stick Flaasch un Knoche,<br>ihr defft m\'r aach alsmohl sonst wos gouts koche."',
                'translation' => 'Wie es so Mode ist rundherum,<br>geht der Hirte zum Essen reihum.<br>Beim Schulipatt braucht man nicht viel Kocherei,<br>er isst am liebsten süßen Brei.<br>Doch als er fünfmal nacheinander Brei musste essen,<br>sagte er: "Davon will ich jetzt nichts mehr wissen.<br>Ich esse ganz gern ein Stück Fleisch und Knochen,<br>ihr dürft mir auch sonst mal was Gutes kochen."'
            ],
            [
                'audio' => '9.mp3',
                'dialect' => 'Its murr aich noch erzehl, wej des es komme,<br>dess Schulipatt sich de Keu hot genomme,<br>sai Vodder deht en Drö\'örroff heure des Vej,<br>un sai Christianpatt, der heuts dou hej.<br>Off e\'mohl loacht der sich zom Sterwe hie<br>un saat ganz laise: "Aich kann naut mie."<br>Owwer d\'r Wilhelm hoat en sich Hörteblout,<br>woas es des fier de Gemoa su gout.',
                'translation' => 'Jetzt muss ich noch erzählen, wie es kam,<br>dass Schulipatt sich die Kühe nahm.<br>Sein Vater hütete in Driedorf das Vieh,<br>und sein Onkel Christian hütet\'s dann hier.<br>Auf einmal legt er sich zum Sterben hin<br>und sagt ganz leise: "Ich kann nicht mehr".<br>Aber der Wilhelm hat in sich Hirtenblut,<br>was ist das für die Gemeinde so gut.'
            ],
            [
                'audio' => '10.mp3',
                'dialect' => 'E\' poar Juhr vierher harr\'e sain Ehstand gegrinnt,<br>hot sich en Fraa gesucht, wej m\'r selten oa findt.<br>\'s Miele richt alles goar häuslich en<br>un schinkt em Wilhelm 10 gesonne Kenn.<br>Wenn de Wilhelm blejß oahm Holderstrauch off\'em Horn<br>gings Miele aach mit - un wihrt\'s Vej vo vorn.<br>Se worn zefriere bainanner allezeit<br>un ginge zesohme durch Freud un Laid.',
                'translation' => 'Ein paar Jahre vorher hat er seinen Ehestand gegründet,<br>hat sich eine Frau gesucht, wie man selten eine findet.<br>Die Miele richtet alles gar häuslich ein<br>und schenkt dem Wilhelm zehn gesunde Kinder.<br>Wenn der Wilhelm am Holderstrauch blies auf dem Horn,<br>ging Miele mit und wehrte dem Vieh von vorn.<br>Sie waren zufrieden beieinander allezeit,<br>sie gingen zusammen durch Freud und Leid.'
            ],
            [
                'audio' => '11.mp3',
                'dialect' => 'Des oans murre de Leu noch wesse,<br>de Krieg hoat beim Schulipatt aach Licke geresse.<br>Zwi Jonge un en Enkel, gesond un schie,<br>dej meht d\'r Schnitter Duud em hie,<br>un noch en Enkel un em Anna sai Mann<br>dej sai als immer noch net dahamm.<br>Oa gruß Maadche er \'em schu freuer gestorwe<br>dej Wund will aach net ganz vernorwe.',
                'translation' => 'Das eine müssen die Leute auch wissen,<br>der Krieg hat beim Schulipatt auch Lücken gerissen.<br>Zwei Jungen und ein Enkel, gesund und schön,<br>die mähte der Schnitter Tod ihm hin.<br>Und noch ein Enkel und Annas Mann<br>sind noch immer nicht daheim.<br>Ein großes Mädchen ist ihm schon füher gestorben,<br>die Wunde will auch nicht ganz vernarben.'
            ],
            [
                'audio' => '12.mp3',
                'dialect' => 'Net nur als Keuhirt wesse m\'r Schulipatt ze schätze,<br>se dou sugoar en de Nochboargemoane dovo schwätze,<br>woas de Wilhelm all em Vej hoat gedou,<br>wej m\'r em Krieg kunnt net immer en Dejeroarzt hu.<br>D\'r oa hat woas o d\'r Kou, d\'r anner o d\'r Gaaß,<br>se koome gelaafe mit Hinkel un Hoas.<br>Den Schoof, den horr\' e de Kutte beschnörre,<br>de Säu horr\' e bai Rootlaaf de Ader gelörre.',
                'translation' => 'Nicht nur als Hirte weiß man den Schulipatt zu schätzen,<br>sogar in Nachbarorten tat man davon schwätzen,<br>was der Wilhelm dem Vieh hat getan,<br>wie im Krieg nicht immer der Tierarzt kam.<br>Der eine hatte was mit der Kuh, der andere mit der Ziege,<br>sie kamen gelaufen mit Huhn und Hase.<br>Den Schafen hat er die Klauen beschnitten,<br>die Schweine bei Rotlauf zur Ader gelassen.'
            ],
            [
                'audio' => '13.mp3',
                'dialect' => 'Hej kimmt des Vejzeug allminoa<br>un mecht Schulipatt e\' Dankeschön soa.<br>Nur de Kou hu m\'r gelörre em Stall,<br>dej mecht us hej zouvill Krawall.<br>De Gaaß hoat Ingst, se greech oa gestriche,<br>drim ess se us ewwe noch ausgewiche.<br>Se lejs e\' poar Kaffiebunn fall\' off de Eer,<br>dej bringe m\'r all Schuli Miele hej her.',
                'translation' => 'Hier kommt das Vieh, alle miteinander<br>und möchten Schulipatt ein Dankeschön sagen.<br>Nur die Kuh haben wir gelassen im Stall,<br>diemacht uns hier zu viel Krawall.<br>Die Ziege hat Angst, sie würde geschlagen,<br>drum ist sie uns eben ausgewichen.<br>Sie ließ ein paar Kaffebohnen fallen auf die Erde,<br>die bringen wir alle Schuli Miele hierher.'
            ],
            [
                'audio' => '14.mp3',
                'dialect' => 'Schulipatt es Noachtswächter näwebai<br>un aach noch e\' Diener d\'r Polizai.<br>gestern ging\'s Anna mit d\'r Schell<br>un rejf: "Ihr Leu, said mohl all fai still,<br>de Bojemoaster hot zougeschickt krejt,<br>es wier ganz bestimmt,<br>dess en Abordnung vohm Landroatsamt zom Hörtefest kimmt.<br>Üwwerhaapt keeme noch mie huhe Herrn<br>dej diere mit ihrem Besuch usen Keuhört ehrn."<br>Dej Schell, dej Schulipatt 50 Juhr durft schwinge,<br>soll hau aach mo rai un hell durch\'s ganze Dorf klinge.',
                'translation' => 'Schulipatt ist Nachtwächter nebenbei,<br>und auch ein Diener der Polizei.<br>Gestern ging Anna mit der Schelle,<br>und rief: "Ihr Leute, seid mal still,<br>dem Bürgermeister wurde geschickt,<br>es wär ganz bestimmt,<br>dass eine Abordnung vom Landratsamt zum Hirtenfest kommt.<br>Überhaupt kämen noch mehr hohe Herren,<br>die mit ihrem Besuch den Kuhhirten ehren."<br>Die Schelle, die Schulipatt 50 Jahr durfte schwingen,<br>sie soll auch heute rein und hell durch\'s Dorf erklingen.'
            ],
            [
                'audio' => '15.mp3',
                'dialect' => 'Nou won m\'r vier allem den net vergesse,<br>der Schulipatt su e\' langes Läwe hoat zougemesse<br>un \'s Miele aach noch lejß gesond,<br>drim woll mör\' em danke aus Herzensgrond,<br>un üwwer dej zwaa Gottes Sehje erbitte,<br>des er se fernerhin noch mecht behüte.<br>Noch oans murr aich soa: "Wej wier des su schie,<br>wenn m\'r en uuser Gemoa immer wej hau zesoame dere stieh."',
                'translation' => 'Nun wollen wir vor allem den nicht vergessen,<br>der Schulipatt ein so langes Leben hat zugemessen,<br>und die Miele auch noch ließ gesund,<br>drum wollen wir ihm danken aus Herzensgrund,<br>und über die beiden Gottes Segen erbitten,<br>dass er sie fürderhin noch möge behüten.<br>Noch eins muss ich sagen: "Wie wäre das schön,<br>wenn uns\'re Gemeinde doch immer würde zusammen steh\'n."'
            ]
        ];

        return view('hirtenfest', compact('verses'));
    }
}