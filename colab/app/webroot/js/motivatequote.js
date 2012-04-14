
var quotes=new Array()

//change the quotes if desired. Add/ delete additional quotes as desired.

quotes[0]='There are some people who live in a dream world, and there are some who face reality; and then there are those who turn one into the other. <i>-By Douglas Everett</i>'

quotes[1]='Whether you think you can or whether you think you can\'t, you\'re right! <i>-Henry Ford</i>'

quotes[2]='I know of no more encouraging fact than the unquestionable ability of man to elevate his life by conscious endeavor. <i>-Henry David Thoreau</i>'

quotes[3]='Do not let what you cannot do interfere with what you can do. <i>-John Wooden</i>'

quotes[4]='Accept everything about yourself - I mean everything, You are you and that is the beginning and the end - no apologies, no regrets. <i>-Clark Moustakas</i>'

quotes[5]='We must accept life for what it actually is - a challenge to our quality without which we should never know of what stuff we are made, or grow to our full stature. <i>-Ida R. Wylie</i>'

quotes[6]='High achievement always takes place in the framework of high expectation. <i>-Jack Kinder</i>'

quotes[7]='The measure of a man is the way he bears up under misfortune. <i>-Plutarch</i>'

quotes[8]='Don\'t wait for your ship to come in, swim out to it. <i>-Anon</i>'

quotes[9]='As I grow older, I pay less attention to what men say. I just watch what they do. <i>-Andrew Carnegie</i>'

quotes[10]='No steam or gas ever drives anything until it is confined. No Niagara is ever turned into light and power until it is tunneled. No life ever grows until it is focused, dedicated, disciplined. <i>-Harry Emerson Fosdick</i>'

quotes[11]='The words printed here are concepts. You must go through the experiences. <i>-Carl Frederick</i>'

quotes[12]='Man cannot discover new oceans unless he has the courage to lose sight of the shore. <i>-Andre Gide</i>'

quotes[13]='The wise man does at once what the fool does finally. <i>-Baltasar Gracian</i>'

quotes[14]='The world has the habit of making room for the man whose actions show that he knows where he is going. <i>-Napoleon Hill</i>'

quotes[15]='Success seems to be connected with action. Successful men keep moving. They make mistakes, but they don\'t quit. <i>-Conrad Hilton</i>'

quotes[16]='Do the things you know, and you shall learn the truth you need to know. <i>-George Macdonald</i>'

quotes[17]='I have never heard anything about the resolutions of the apostles, but a good deal about their acts. <i>-Horace Mann</i>'

quotes[18]='Let us not be content to wait and see what will happen, but give us the determination to make the right things happen. <i>-Peter Marshall</i>'

quotes[19]='I hear and I forget, I see and I remember. I do and I understand. <i>-Chinese Proverb</i>'

quotes[20]='One may walk over the highest mountain one step at a time. <i>-John Wanamaker</i>'

quotes[21]='Every action is either strong or weak, and when every action is strong we are successful. <i>-Wallace D. Wattles</i>'

quotes[22]='If we do what is necessary, all the odds are in our favor. <i>-Henry Kissinger</i>'

quotes[23]='Little minds are tamed and subdued by misfortune; but great minds rise above them. <i>-Washington Irving</i>'

quotes[24]='When an affliction happens to you, you either let it defeat you, or you defeat it... <i>-Rosalind Russell</i>'

quotes[25]='There\'s a basic human weakness inherent in all people which tempts them to want what they can\'t have and not want what is readily available to them. <i>-Robert J. Ringer</i>'

quotes[26]='If there is something to gain and nothing to lose by asking, by all means ask! <i>-W. Clement Stone</i>'

quotes[27]='It\'s not the situation ... It\'s your reaction to the situation <i>-Robert Conklin</i>'

quotes[28]='Life at any time can become difficult: life at any time can become easy.  It all depends upon how one adjusts oneself to life. <i>-Morarji Desai</i>'

quotes[29]='What happens is not as important as how you react to what happens. <i>-Thaddeus Golas</i>'

quotes[30]='To hell with circumstances; I create opportunities. <i>-Bruce Lee</i>'

var whichquote=Math.floor(Math.random()*(quotes.length))
function inspire(){
	document.write(quotes[whichquote]);
}
