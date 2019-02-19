<?php
/**
 * Created by PhpStorm.
 * User: Unforgiven-PC
 * Date: 18/02/2019
 * Time: 19:56
 */

namespace OC\BookingBundle\Services;


class Handler
{
    /**
     * @param $date
     * @param $type
     * @param $reducPrice
     * @return int
     * @throws \Exception
     */
    public function handleBill($date, $type, $reducPrice)
    {
        $dtToday = new \DateTime();
        $dt = $dtToday->format('Y');

        $diff = $dt - $date;
        $total = 0;

        /**
         * There's two type of tickets => Full-Day & Half-Day
         * Full-Day = from 9am
         * Half-Day = from 2pm
         * There's also two type of price reduction : With or Without reduction (50% off on tickets prices)
         * Reduction is allowed under conditions : you must provide a proof (Student, soldier, employee of Ministery, ...)
         * Tickets for childs under 4 years old is free
         */

        //If ticket type is full-day
        if($type == 1) {
            //If reduction is NOT applied
            if($reducPrice == false)
            {
                //Child price [Full-Day] (>= 4 yo && > 12 yo)
                if($diff >= 4 && $diff < 12) {
                    $total = 8;
                }
                //Normal price [Full-Day] (>= 12 yo & < 60 yo)
                elseif($diff >= 12 && $diff < 60) {
                    $total = 16;
                }
                //Senior price [Full-Day] (> 60 yo)
                elseif($diff >= 60)
                {
                    $total = 12;
                }
                //Baby price [Full-Day] (< 4 yo) / FREE
                elseif ($diff < 4) {
                    $total = 0;
                }
            }
            //If reduction is applied (50% off on Normal & Senior prices)
            else {
                //Child price [Full-Day] (>= 4 yo && > 12 yo)
                if($diff >= 4 && $diff < 12) {
                    $total = 8;
                }
                //Normal price [Full-Day] (>= 12 yo & < 60 yo)
                elseif($diff >= 12 && $diff < 60) {
                    $total = 10;
                }
                //Senior price [Full-Day] (> 60 yo)
                elseif($diff >= 60)
                {
                    $total = 10;
                }
                //Baby price [Full-Day] (< 4 yo) / FREE
                elseif ($diff < 4) {
                    $total = 0;
                }
            }
        }
        //If ticket type is half-day
        else {
            //If reduction is NOT applied
            if($reducPrice == false)
            {
                //Child price [Half-Day] (>= 4 yo && > 12 yo)
                if($diff >= 4 && $diff < 12) {
                    $total = 4;
                }
                //Normal price [Half-Day] (>= 12 yo & < 60 yo)
                elseif($diff >= 12 && $diff < 60) {
                    $total = 8;
                }
                //Senior price [Half-Day] (> 60 yo)
                elseif($diff >= 60)
                {
                    $total = 6;
                }
                //Baby price [Half-Day] (< 4 yo) / FREE
                elseif ($diff < 4) {
                    $total = 0;
                }
            }
            //If reduction is applied (50% off on Normal & Senior prices)
            else {
                //Child price [Half-Day] (>= 4 yo && > 12 yo)
                if($diff >= 4 && $diff < 12) {
                    $total = 4;
                }
                //Normal price [Half-Day] (>= 12 yo & < 60 yo)
                elseif($diff >= 12 && $diff < 60) {
                    $total = 5;
                }
                //Senior price [Half-Day] (> 60 yo)
                elseif($diff >= 60)
                {
                    $total = 5;
                }
                //Baby price [Half-Day] (< 4 yo) / FREE
                elseif ($diff < 4) {
                    $total = 0;
                }
            }
        }
        return $total;
    }
}