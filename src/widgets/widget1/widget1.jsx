import React, { useState, useEffect } from 'react';

const Widget1 = ({ data }) => {
  const [posts, setPosts] = useState([]);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState(null);
  useEffect(() => {
    const fetchPosts = async () => {
      try {
        setIsLoading(true);
        const response = await fetch(
          '/wp-json/wp/v2/posts?_fields=id,title,excerpt&per_page=10'
        );
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        setPosts(data);
      } catch (error) {
        console.error('Error fetching posts:', error);
        setError('Failed to fetch posts. Please try again later.');
      } finally {
        setIsLoading(false);
      }
    };

    fetchPosts();
  }, []);

  if (isLoading) return <p>Loading posts...</p>;
  if (error) return <p>{error}</p>;
  if (data.length === 0) {
    return <p>Rerender</p>;
  }

  return (
    <div>
      <h2>{data.title}</h2>
      <ul>
        {posts.map((post) => (
          <li key={post.id}>
            <h3>{post.title.rendered}</h3>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default Widget1;
