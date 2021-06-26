<?php
use Psr\Http\Message\ServerRequestInterface;

use Goose\Client as GooseClient;

function helloHttp(ServerRequestInterface $request): string
{
    $body = $request->getBody()->getContents();
    if (!empty($body)) {
        $json = json_decode($body, true);
        if (json_last_error() != JSON_ERROR_NONE) {
            throw new RuntimeException(sprintf(
                'Could not parse body: %s',
                json_last_error_msg()
            ));
        }

        $goose = new GooseClient();
        $article = $goose->extractContent($json['url']);
        return json_encode([
            "title" => $article->getTitle(),
            "metaDescription" => $article->getMetaDescription(),
            "metaKeywords" => $article->getMetaKeywords(),
            "canonicalLink" => $article->getCanonicalLink(),
            "domain" => $article->getDomain(),
            "tags" => $article->getTags(),
            "links" => $article->getLinks(),
            "videos" => $article->getVideos(),
            "articleText" => $article->getHtmlArticle(),
            "entities" => $article->getPopularWords(),
            "image" => $article->getTopImage(),
            "allImages" => $article->getAllImages(),
        ]);
    }
    return "{}";
}
