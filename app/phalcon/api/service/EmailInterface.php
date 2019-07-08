<?php
/**
 * @package Millipede\Api
 * @author Maciej Trybuła <maciej.trybula@gmail.com>
 * @copyright 2018 Trysoft
 */

namespace Millipede\Api\Services;

/**
 * Interface EmailInterface
 */
interface EmailInterface
{
    const SUBJECT = '[A-TEAM] Millipede for next 2 weeks' . "\r\n";
    const HEADER_MIME_VERSION = 'MIME-Version: 1.0' . "\r\n";
    const HEADER_CONTENT_TYPE = 'Content-type:text/html;charset=UTF-8' . "\r\n";
    const HEADER_FROM = 'From: Millipede' . "\r\n";
    const EMAIL_STATUS_SENT = 'sent';
    const EMAIL_STATUS_NOT_SENT = 'not_sent';

    /**
     * @param string $to
     * @param string $message
     *
     * @return bool
     */
    public function sendEmail(string $to, string $message): bool;

    /**
     * @param array $millipede
     *
     * @return array
     */
    public function sendEmails(array $millipede): array;

    /**
     * @param array $millipede
     *
     * @return string
     */
    public function prepareMessage(array $millipede): string;
}
