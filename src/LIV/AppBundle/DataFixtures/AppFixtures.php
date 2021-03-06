<?php
namespace LIV\AppBundle\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use LIV\AppBundle\Entity\Address;
use LIV\AppBundle\Entity\EventCategory;
use LIV\AppBundle\Entity\Event;
use LIV\AppBundle\Entity\EventImage;
use LIV\AppBundle\Entity\Interview;
use LIV\AppBundle\Entity\InterviewImage;
use LIV\AppBundle\Entity\Place;
use LIV\AppBundle\Entity\PlaceCategory;
use LIV\AppBundle\Entity\PlaceImage;
use LIV\AppBundle\Entity\Tag;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $commonCategory = new PlaceCategory();
        $commonCategory->setName("common");
        $manager->persist($commonCategory);
        $commonTag = new Tag();
        $commonTag->setName("common-tag");
        $manager->persist($commonTag);
        #FIXTURES FOR EVENTS
        $commonEventCategory = new EventCategory();
        $commonEventCategory->setName("common");
        $manager->persist($commonEventCategory);

        for ($i = 0; $i < 10; $i++) {
            //CREATE 10 TAGS
            $tag = new Tag();
            $tag->setName("tag-".$i);
            $manager->persist($tag);
            //CREATE 10 CATEGORIES OF PLACE
            $categoriePlaces = new PlaceCategory();
            $categoriePlaces->setName("my super category ".$i);
            $manager->persist($categoriePlaces);
            //CREATE 10 ADRESS
            $address = new Address();
            $address->setCity("lyon");
            $address->setZipCode("69003");
            $address->setStreet("avenue thiers");
            $address->setStreetNumber($i);
            //CREATE 10 PLACES
            $place = new Place();
            $place->setAddress($address);
            $place->setName("place-".$i);
            $place->setRating(round($i/4));
            $place->setShortDescription("short description of my beautifull restaurant come on");
            $place->setFullDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rhoncus turpis ac lacus interdum porta. Proin aliquet accumsan purus, sed consectetur nisi vestibulum at. Praesent non dictum ipsum. Nunc fermentum velit ligula, non volutpat nisi fermentum ut. Sed sollicitudin ante ut diam ornare congue. Aenean efficitur arcu metus, a malesuada urna tincidunt eget. Integer commodo ante vitae metus egestas, sit amet sollicitudin sapien egestas. Cras vehicula elit id orci bibendum, euismod hendrerit velit semper.");
            $place->setLatitude(45.7788368);
            $place->setLongitude(4.872813299999962);
            $place->setInformation("Lundi - Samedi : 16h - 01H   Dimanche : 13h - 19h");
            $place->setLink("https://www.hopperlyon.com");
            $place->addTag($commonTag);
            $place->addTag($tag);
            // ADD PLACES TO CATEGORIES
            $place->addCategory($commonCategory);
            $place->addCategory($categoriePlaces);
            //ADD IMAGES
            $image = new PlaceImage();
            $image->setImage("demo.jpg");
            $image->setUpdatedAt(new \DateTime('now'));
            $image->setPlace($place);
            $image2 = new PlaceImage();
            $image2->setImage("demo2.jpg");
            $image2->setUpdatedAt(new \DateTime('now'));
            $image2->setPlace($place);
            $place->addImage($image);
            $place->addImage($image2);
            $place->setVideo("https://www.youtube.com/embed/rrpp8lUufk8");
            $manager->persist($place);
            // EVENT FIXTURES
            //CREATE 10 CATEGORIES OF EVENTS
            $eventCategory = new EventCategory();
            $eventCategory->setName("eventCategory-" . $i);
            $manager->persist($eventCategory);
            //CREATE 10 EVENTS
            $event = new Event();
            $event->setName("event-" . $i);
            $event->setStartingDate(new \DateTime('now'));
            $event->setEndingDate(new \DateTime('tomorrow'));
            $event->setShortDescription("Short description of this amazing event, let's go guys");
            $event->setFullDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit.Quisque rhoncus turpis ac lacus interdum porta. Proin aliquet accumsan purus, sed consectetur nisi vestibulum at. Praesent non dictum ipsum. Nunc fermentum velit ligula, non volutpat nisi fermentum ut. Sed sollicitudin ante ut diam ornare congue. Aenean efficitur arcu metus, a malesuada urna tincidunt eget. Integer commodo ante vitae metus egestas, sit amet sollicitudin sapien egestas. Cras vehicula elit id orci bibendum, euismod hendrerit velit semper.");
            $event->setLinkOrganiser("https://www.accorhotelsarena.com/fr/evenements-a-paris/toute-la-programmation");
            $event->setLinkTicketing("https://www.digitick.com/tr/event/post-malone/accorhotels-arena/5800855");
            $event->addCategory($commonEventCategory);
            $event->addCategory($eventCategory);
            $event->setLatitude(45.7788368);
            $event->setLongitude(4.872813299999962);
            $event->addTag($commonTag);
            $event->addTag($tag);
            $event->setAddress($address);
            $event->setVideo("https://www.youtube.com/embed/rrpp8lUufk8");
            // ADD IMAGES TO EVENT
            $eventImage1 = new EventImage();
            $eventImage1->setImage('demo-event1.jpg');
            $eventImage1->setEvent($event);
            $eventImage1->setUpdatedAt(new \DateTime('now'));
            $event->addImage($eventImage1);
            $eventImage2 = new EventImage();
            $eventImage2->setImage('demo-event2.jpg');
            $eventImage2->setEvent($event);
            $eventImage2->setUpdatedAt(new \DateTime('now'));
            $event->addImage($eventImage2);
            $manager->persist($event);
        }
        $manager->flush();
        $this->loadInterview($manager);
    }

    public function loadInterview(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; $i++) {
            $interview = new Interview();
            $interview->setArtiste('Cap_Phi'.$i);
            $interview->setLocalisation('descente de la croix rousse');
            $interview->setInfo("Cap Phi est un street artist et infographiste Lyonnais issu d’une culture prolétaire.");
            $interview->setContent('Cap Phi est un street artist et infographiste Lyonnais issu d’une culture prolétaire. Il a
                                découvert le street art dans les rues Lyonnaises, et le pratique lui-même depuis 2010. Sa
                                vision de l’Art repose sur le concept d’« Art Modeste » d’Hervé Di Rosa, qui n’établit pas de
                                hiérarchie entre les différentes formes d’Art et qui place l’émotion au centre de toute
                                compréhension artistique. Son art est reconnaissable : il met en scène des petits monstres,
                                dans un style très cartoon et coloré.');

            $interviewImage1 = new InterviewImage();
            $interviewImage1->setImage('demo-event1.jpg');
            $interviewImage1->setInterview($interview);
            $interviewImage1->setUpdatedAt(new \DateTime('now'));

            $interviewImage2 = new InterviewImage();
            $interviewImage2->setImage('demo-event2.jpg');
            $interviewImage2->setInterview($interview);
            $interviewImage2->setUpdatedAt(new \DateTime('now'));

            $manager->persist($interview);
            $manager->persist($interviewImage1);
            $manager->persist($interviewImage2);
        }
        $manager->flush();
    }
}
