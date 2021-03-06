<?php

use Illuminate\Database\Seeder;
use iobom\Models\Barrio;
use iobom\Models\Parroquia;

class ParrquiasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parroquias = array(
        'Toacazo',
        'San Juan de Pastocalle',
        'Mulaló',
        'Tanicuchí',
        'Guaytacama',
        'Aláquez',
        'Poaló',
        'Once de Noviembre',
        'Belisario Quevedo',
        'Joseguango Bajo',
        'Eloy Alfaro',
        'Ignacio Flores',
        'Juan Montalvo',
        'La Matriz',
        'San Buenaventura'
        );
        $codigo=0;
        foreach ($parroquias as $parroquia) {
            $codigo++;
            Parroquia::firstOrCreate(['nombre' => $parroquia,'codigo'=>$codigo]);
        }

        

        $barrios = array(
            'Cuicuno Sur---1',
            'La Libertad---1',
            'Loma de Monjas---1',
            'Yugsiche Bajo---1',
            'Pintze Chico---1',
            'Pilacumbi---1',
            'Chilla Buena Esperanza---1',
            'Samana ---1',
            'Razuyacu Corazón De Jesús---1',
            'Vicente León ---1',
            'Quinte Buena Esperanza---1',
            'Quinte San Antonio---1',
            'Cotopilaló---1',
            'Patria Nueva---1',
            'Wintza Wuagrahuasi---1',
            'Huingopana---1',
            'Chisulchi Grande---1',
            'Chisulchi Chico---1',
            'Quillusillín ---1',
            'Moya San Agustin---1',
            'Moya Grande---1',
            'San Francisco---1',
            'Yanahurquito San Antonio---1',
            'Yanahurquito Chico---1',
            'San Bartolo---1',
            'San Carlos---1',
            'Chilsaló---1',
            'San José de Toacazo---1',
            'El Calvario---1',
            'Planchaloma---1',
            'Toacazo Centro ---1',
            'San José---2',
            'Tandacato---2',
            'Santa Rosa---2',
            'El Milagro---2',
            'Matango---2',
            'Pastocalle Viejo---2',
            'Ortuño---2',
            'Miño de San Antonio---2',
            'Pasto Alto---2',
            'San Pedro de Tenería---2',
            'San Bartolomé---2',
            'San Francisco del Chasqui---2',
            'Santa Rita---2',
            'Cuilche Miño---2',
            'Chuilche Salas---2',
            'Romerillos---2',
            'La Libertad---2',
            'El Progreso---2',
            'San Antonio de Tandaco---2',
            'San Diego---2',
            'El Rosario---2',
            'Calvache---2',
            'Pucará---2',
            'San Luis de Yacupungo---2',
            'Guapulo---2',
            'Boliche---2',
            'San Joaquin---2',
            'La Dolorosa---2',
            'Curiquingue ---2',
            'Buena Vista---2',
            'Luz y Vida---2',
            'San Vicente de Luto ---2',
            'Campamento---2',
            'Chinchil de robayos---3',
            'Chinchil de villamarin---3',
            'Churo pinto santa catalina ---3',
            'Colcas Zona de Protección y Albergue---3',
            'El Caspi---3',
            'El Rosal---3',
            'La Libertad---3',
            'Macalo Chico---3',
            'Macalo Grande---3',
            'Mancheno---3',
            'Mulalo Centro ---3',
            'Quisinche Alto ---3',
            'Rumipamba de Espinozas ---3',
            'Rumipamba de san Isidro---3',
            'Rumipamba de Villacis---3',
            'Salatilin---3',
            'San Antonio de Limache---3',
            'San Francisco de Espinozas ---3',
            'Ticatilin---3',
            'Trompucho---3',
            'Ashingua---3',
            'José Guango Alto---3',
            'San Agustin---3',
            'San Bartolo Tanitan---3',
            'San Ramon---3',
            'Langualo Grande---3',
            'Centro---4',
            'La Floresta---4',
            'Santa Clara Centro---4',
            'Cajón Veracruz---4',
            'Santa Ana Centro ---4',
            'Santa Ana Alto---4',
            'Rioblanco Alto---4',
            'Rioblanco de Lasso---4',
            'Lasso---4',
            'La Florida---4',
            'El Vergel---4',
            'Rayo Cruz---4',
            'Santa Clara Norte---4',
            'Coba Santa Clara---4',
            'Goteras Yánez---4',
            'Goteras Cinco de Junio---4',
            'Pucara---4',
            'San Antonio de Luzun---4',
            'Llactayo Grande---4',
            'Llactayo San Isidro---4',
            'San Vicente de Tashima---4',
            'Samilpamba---4',
            'El Calvario---4',
            'Chilcapamba Sur---4',
            'Chilcapamba Norte---4',
            'San José---4',
            'San Pedro  ---4',
            'San Andres.---4',
            'El Calvario---5',
            'La Floresta---5',
            'Pilacoto---5',
            'La Libertad---5',
            'Santa Inés---5',
            'San Sebastián---5',
            'Santa Ana---5',
            'Cevallos---5',
            'Pupana Sur---5',
            'Pupana Norte---5',
            'Yanashpa---5',
            'Guamani Narvaez---5',
            'Cuicuno ---5',
            '12 de Octubre---5',
            'Barrio Centro ---5',
            'Aláquez Centro---6',
            'Colaya Achupallas---6',
            'Pilatan Oriente---6',
            'Colaya Jurídico---6',
            'Colaya – Pamba---6',
            'Cuchitingue---6',
            'Crusillí---6',
            'Chaguana---6',
            'Chillos---6',
            'Chitan Aláquez---6',
            'Santa Elena de Cuchitingue---6',
            'El Banco San Isidro Alto---6',
            'El Calvario---6',
            'El Tejar---6',
            'Isimbo---6',
            'Jerusalén – Pumahua---6',
            'Laigua de Bellavista---6',
            'Laigua de Maldonado---6',
            'Laigua de Vargas---6',
            'Langualó Chico---6',
            'Pillig---6',
            'San Antonio---6',
            'San Marcos Oriente---6',
            'San Isidro---6',
            'Tandaliví---6',
            'Vargas Suárez---6',
            'Verdecocha---6',
            'Pilatan Occidente---6',
            'San Marcos Occidente---6',
            'Laigua Simón Rodríguez---6',
            'Maca---7',
            'Pillicsillí ---7',
            'Eloy Alfaro,---7',
            'San Vicente, ---7',
            'Las Parcelas, ---7',
            'Marquez de Maenza ---7',
            'Luz de América ---7',
            'Bellavista ---7',
            'Chantilín Chico---7',
            'La Compañía ---7',
            'Mariscal Sucre  ---7',
            'Santa Rosa, mientras---7',
            'Angahuana---7',
            'Centro ---8',
            'La Unión ---8',
            'San Pedro---8',
            'Centro---9',
            'Illuchi---9',
            'Forastero---9',
            'La Cangagua---9',
            'Guanailín Batallas ---9',
            'Chávez Pamba---9',
            'San Miguel---9',
            'Santa Rosa---9',
            'La Merced---9',
            'San Antonio---9',
            'Potrerillos---9',
            'Chaupi Contadero  ---9',
            'San Lorenzo---9',
            'Miravalle---9',
            'San Luis---9',
            'San Francisco---9',
            'Culaguango Centro---9',
            'La Dolorosa---9',
            'La Compañía---9',
            'Manzanapamba---9',
            'Tunducama---9',
            'Pishicapamba---9',
            'Galpón Loma---9',
            'Guanailín ---9',
            'Jose Guango---10',
            'El Calvario Sur---11',
            'El Chofer---11',
            'El Ejido---11',
            'El Mecánico---11',
            'El Rosario---11',
            'Estupiñán---11',
            'Jaime Hurtado (UNE)---11',
            'La Banda---11',
            'Urbanización San Felipe---11',
            'La Estación ---11',
            'La Estación Norte---11',
            'La Estación Sur---11',
            'La Ferroviaria---11',
            'Las Fuentes---11',
            'Los Arupos---11',
            'Los Molinos---11',
            'Los Nevados---11',
            'Los Sauces---11',
            'Maldonado Toledo---11',
            'Rumipamba---11',
            'San Felipe---11',
            'Universitaria---11',
            'Vásconez Cuvi---11',
            'Zumbalica---11',
            'Patutan---11',
            'La Calera---11',
            'Urbanizaciòn UNE---11',
            'Andinatel---12',
            'Ashpacruz---12',
            'Bethlemitas---12',
            'El Chofer 2---12',
            'El Chofer 3---12',
            'El Loreto---12',
            'IESS---12',
            'La Laguna ---12',
            'Los Pinos---12',
            'Miraflores---12',
            'Niagara ---12',
            'Niagara Mirador---12',
            'Nintinacazo---12',
            'Patria---12',
            'Pillic Centro---12',
            'Registro civil---12',
            'Rincón del Cotopaxi---12',
            'Sigsicalle Sur---12',
            'Sur---12',
            'Tiobamba---12',
            'Tiobamba de Rojas---12',
            'Urbanización La Colina---12',
            'Urbanización Mario Mogollón---12',
            'Urbanización Nintinacazo---12',
            'Urbanización Reina del Cisne---12',
            'Urbanización San Carlos---12',
            'Urbanización San Francisco---12',
            'Urbanización Vista Hermosa---12',
            'Urbanización Vista Hermosa 2---12',
            'Sur Centro---12',
            'La Colina---12',
            'Gualundún---13',
            'Isimbo---13',
            'La Cocha ---13',
            'La Cocha Norte---13',
            'Locoa ---13',
            'Miraflores Mirador---13',
            'San Martín---13',
            'Urbanización CEDAL---13',
            'Urbanización del MOP---13',
            'Urbanización La Alsacia---13',
            'Urbanización Locoa---13',
            'Urbanización Miño Molina---13',
            'Carmen FAE---14',
            'Carmen IESS---14',
            'Centro---14',
            'Chiriboga Jácome---14',
            'El Carmen Norte---14',
            'El Nilo---14',
            'El Salto---14',
            'Estrella de Israel---14',
            'La FAE---14',
            'La Inmaculada---14',
            'La Libertad---14',
            'La Merced---14',
            'Molinos Poultier---14',
            'Monserrat---14',
            'San Agustín---14',
            'San Blas---14',
            'San Francisco---14',
            'San Sebastián---14',
            'Sigsicalle Norte---14',
            'Urbanización Libertad y trabajo ---14',
            'San Sebastián---14',
            'Aeropuerto Cotopaxi---15',
            'Aranjuez---15',
            'Área comunal El Ejido comunal---15',
            'Área comunal San Marcos---15',
            'Centro San Buenaventura---15',
            'Chile---15',
            'Colaisa---15',
            'Colaisa Quililumbo---15',
            'Colaisa San Francisco---15',
            'Colaisa Santo Domingo---15',
            'Condominios la  FAE---15',
            'La Libertad---15',
            'María Jacinta ---15',
            'Nueva Vida---15',
            'Santa Barbara---15',
            'Urbanización Colaisa---15',
            'Urbanización Estrella de la Mañana---15',
            'Lotización Karolys---15',
            'Vertientes del Cotopaxi---15',
        );
        $codigo_p=0;
        foreach ($barrios as $barrio) {
            $codigo_p++;
            $codigoParroquia=explode('---',$barrio);
            $parroq=Parroquia::where('codigo',$codigoParroquia[1])->first();
            if($parroq){
                Barrio::firstOrCreate(['nombre' => $codigoParroquia[0],'codigo'=>$codigo_p.'-'.$parroq->codigo,'parroquia_id'=>$parroq->id]);
            }
        }

    }
}
