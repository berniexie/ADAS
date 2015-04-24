<?php
//ini_set('memory_limit', '-1');
include_once('Paper.php');
class ResearchPaperAPI
{

    private $stop_words = array('a','about','above','after','again', 'know', 'like' ,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
                                'against','all','am','an','and','any','are','arent', 'us', 'tell', 'let', 'oh', 'can', 'got', 'makes', 'just', 'get',
                                'as','at','be','because','been','before','being',
                                'below','between','both','but','by','cant','cannot',
                                'could','couldnt','did','didnt','do','does','doesnt',
                                'doing','dont','down','during','each','few','for','from','further',
                                'had','hadnt','has','hasnt','have','havent','having','he','hed',
                                'hell','hes','her','here','heres','hers','herself','him','himself','his',
                                'how','hows','i','id','ill','im','ive','if','in','into','is','isnt','it',
                                'its','itself','lets','me','more','most','mustnt','my','myself','no','nor',
                                'not','of','off','on','once','only','or','other','ought','our','ours','ourselves',
                                'out','over','own','same','shant','she','shed','shell','shes','should','shouldnt',
                                'so','some','such','than','that','thats','the','their','theirs',
                                'them','themselves','then','there','theres','these','they','theyd','theyll',
                                'theyre','theyve','this','those','through','to','too','under','until','up','very',
                                'was','wasnt','we','wed','well','were','weve','were','werent','what','whats',
                                'when','whens','where','wheres','which','while','who','whos','whom','why',
                                'whys','with','wont','would','wouldnt','you','youd','youll','youre',
                                'youve','your','yours','yourself','yourselves');

    public function __construct()
    {

    }

    public function getPapersByAuthor($authorName, $limit = 10)
    {
        $qAuthor = preg_replace('/\s+/', "%20", $authorName);
        $queryString = "http://ieeexplore.ieee.org/gateway/ipsSearch.jsp?au=" . $qAuthor . "&hc=" . $limit;
        return $this->getPapersByQuery($queryString);
        
    }

    public function getPapersByKeyWords($searchPhrase, $limit = 10)
    {
        $qPhrase = preg_replace('/\s+/', "%20", $searchPhrase);
        $queryString = "http://ieeexplore.ieee.org/gateway/ipsSearch.jsp?querytext=" . $qPhrase . "&hc=" . $limit;
        return $this->getPapersByQuery($queryString);
    }

    public function getPapersByJournal($journal, $limit = 10)
    {
        $qJournal = preg_replace('/\s+/', "%20", $journal);
        $queryString = "http://ieeexplore.ieee.org/gateway/ipsSearch.jsp?querytext=" . $qJournal . "&hc=" . $limit;
        return $this->getPapersByQuery($queryString);

    }

    private function getPapersByQuery($query)
    {
        $xml = new SimpleXMLElement(file_get_contents($query));
        $papers = array();
        foreach ($xml->document as $d) {
            $title = $d->title;
            $authors = $d->authors;
            if($authors[0] == "") continue;
            $authors = explode(";", $authors);
            $journal = $d->pubtitle;
            $id = $d->publicationId;
            
            $content = $d->abstract;
            $content = str_replace("'", '', $content);
            $content = preg_replace('/<[^>]*>/', '', $content);
            $content = preg_replace("/[^A-Za-z ]/", '', $content);
            $content = strtolower($content);

            $content = preg_split('/\s+/', $content);
            $content_temp = $content;
            $content = array();
            foreach ($content_temp as $word) {
                if (!in_array($word, $this->stop_words)) {
                    $content[] = (string)$word; //cast to string
                }
            }
            $content_temp = $content;
            $content = array();
            foreach ($content_temp as $word) {
                if(array_key_exists($word, $content)) {
                    $content[$word]++;
                }
                else {
                    $content[$word] = 1;
                }
            }
            $link = $d->mdurl;

            $p = new Paper((string)$id, $authors, (string)$title, (string)$journal, $content, (string)$link); //cast to string
            $papers[] = $p;
        }
        return $papers;
    }
}
?>
