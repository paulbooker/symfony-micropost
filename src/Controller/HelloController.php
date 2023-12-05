<?php
	
namespace App\Controller;

use App\Entity\Comment;
use App\Entity\MicroPost;
use App\Entity\User;
use App\Entity\UserProfile;
use App\Repository\CommentRepository;
use App\Repository\MicroPostRepository;
use App\Repository\UserProfileRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HelloController extends AbstractController
{
	private array $messages = [
	    ['message' => 'Hello', 'created' => '2023/11/12'],
	    ['message' => 'Hi', 'created' => '2023/10/12'],
	    ['message' => 'Bye!', 'created' => '2022/05/12']
	];
	
	#[Route('/', name: 'app_index')]
	public function index(MicroPostRepository $posts, CommentRepository $comments, UserProfileRepository $profiles, EntityManagerInterface $entityManager): Response
	{
		//$post  = new MicroPost();
		//$post->setTitle('Hello');
		//$post->setText('Hello');
		//$post->setCreated(new DateTime());
		
		//$post = $posts->find(11);
		//$comment = $post->getComments()[0];
		
		//$post->removeComment($comment);

		//$entityManager->persist($post);
	    //$entityManager->flush();
		
		//dd($post);
		
		//$comment = new Comment();
		//$comment->setText('Hello');
		//$comment->setPost($post);
		//$post->addComment($comment);
		
		//$entityManager->persist($comment);
	    //$entityManager->flush();
		
		
		//$user = new User();
		//$user->setEmail('somebody@somewhere.com');
		//$user->setPassword('password');
		
		//$profile = new UserProfile();
		//$profile->setUser($user);
		//$entityManager->persist($profile);
	    //$entityManager->flush();
		
		//$profile = $profiles->find(1);
		//$entityManager->remove($profile);
	    //$entityManager->flush();
		
		return $this->render(
			'hello/index.html.twig',
			[
				'messages' => $this->messages,
				'limit' => 3
			]
		);
		
	}
	
	#[Route('/messages/{id<\d+>}', name: 'app_show_one')]
	public function showOne(int $id): Response
	{
		return $this->render(
			'hello/show_one.html.twig',
			[
				'message' => $this->messages[$id]
			]
		);
		//return new Response($this->messages[$id]);	
	}
}