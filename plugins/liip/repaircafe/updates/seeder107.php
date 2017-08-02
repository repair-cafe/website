<?php namespace Liip\RepairCafe\Updates;

use Liip\RepairCafe\Models\Cafe;
use Liip\RepairCafe\Models\Link;
use Seeder;
use Liip\RepairCafe\Models\Contact;

class Seeder107 extends Seeder
{
    public function run()
    {
        // create dummy Repair-Cafe
        $cafe = Cafe::where('id', '9990')->first();
        if($cafe == null) {
            $cafe = Cafe::create([
                'id' => '9990',
                'title' => 'Flick Kafi Horgen',
                'description' => '<p>Unter dem Namen “Flick-Kafi Horgen” besteht ein Verein gemäss den vorliegenden <a href="http://www.flick-kafi-horgen.ch/images/verein/Flick-Kafi-Horgen-Vereins-Statuten.pdf" target="_blank" title="Statuten">Statuten&nbsp;</a>und im Sinne von Artikel 60 ff. des Schweizerischen Zivilgesetzbuches.</p>

<p>Der Verein ist politisch und konfessionell unabhängig, verfolgt keine kommerziellen Zwecke und erstrebt keinen Gewinn. Die Organe sind ehrenamtlich tätig.</p>

<p>Der Zweck des Vereins ist die Organisation und Durchführung eines "Repair Cafés". Ein "<a href="https://www.konsumentenschutz.ch/repaircafe/" target="_blank" title="Stiftung für Konsumentenschutz">Repair Café</a>" ist eine öffentliche Reparaturdienst-Veranstaltung, welche in ganz Europa schon sehr bekannt ist. Der Verein bezweckt mit seiner Tätigkeit die Vermeidung von Abfall jeder Art und damit einhergehend von Ressourcenverschwendung. Der Verein trägt damit zu einem nachhaltigen Umgang mit der Umwelt bei. Überdies wird mit der Tätigkeit des Vereins bezweckt, dass Gebrauchsgegenstände länger verwendet werden können. Damit unterstützt der Verein indirekt auch Bevölkerungskreise, welche finanzielle Einschränkungen zu tragen haben. Gleichzeitig sieht der Verein die Hilfe zur Selbsthilfe als zentrale Aufgabe.</p>

<p>Der Verein befindet sich in Horgen und organisiert mehrere Flick-Kafi-Veranstaltungen pro Jahr. Dabei werden von Fachleuten gratis Reparaturdienste angeboten. Dieses Angebot kann von allen in Anspruch genommen werden. Die Einzelheiten über die Nutzungsbedingungen des Flick-Kafi werden in der<span>&nbsp;</span><a href="http://www.flick-kafi-horgen.ch/images/verein/Flick-Kafi-Hausordnung.pdf">Hausordnung&nbsp;</a>geregelt.</p>',
                'slug' => 'flick-kafi-horgen',
                'street' => 'Bergstrasse 52',
                'city' => 'Horgen',
                'zip' => '8810',
            ]);
        }

        // create dummy Contacts for repair-cafe
        $contact = Contact::where('id', '9991')->first();
        if($contact == null) {
            $contact = Contact::create([
                'id' => '9991',
                'firstname' => 'Vreni',
                'lastname' => 'Rothacher',
                'email' => 'vreni@horgen.ch',
                'phone' => '05678923452',
                'facebook' => 'vreniBook',
                'twitter' => 'vreniTweets',
                'cafe_id' => '9990',
            ]);
        }
        $contact = Contact::where('id', '9992')->first();
        if($contact == null) {
            $contact = Contact::create([
                'id' => '9992',
                'firstname' => 'Urs',
                'lastname' => 'Länzlinger',
                'email' => 'urs@horgen.ch',
                'phone' => '05678923452',
                'facebook' => 'ursBook',
                'twitter' => 'ursTweets',
                'cafe_id' => '9990',
            ]);
        }
        $contact = Contact::where('id', '9993')->first();
        if($contact == null) {
            $contact = Contact::create([
                'id' => '9993',
                'firstname' => 'Wolly',
                'lastname' => 'Schäfer',
                'email' => 'wolly@horgen.ch',
                'phone' => '05678923452',
                'facebook' => 'wollyBook',
                'twitter' => 'wollyTweets',
                'cafe_id' => '9990',
            ]);
        }

        // create dummy Links
        $link = Link::where('id', '9994')->first();
        if($link == null) {
            $link = Link::create([
                'id' => '9994',
                'url' => 'flickkafihorgen',
                'linktype_id' => '9980',
                'cafe_id' => '9990',
            ]);
        }
        $link = Link::where('id', '9995')->first();
        if($link == null) {
            $link = Link::create([
                'id' => '9995',
                'url' => 'http://www.flick-kafi-horgen.ch/',
                'linktype_id' => '9982',
                'cafe_id' => '9990',
            ]);
        }

    }
}
