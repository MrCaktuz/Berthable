import { NextRequest, NextResponse } from "next/server";

import Recipe from "@/models/Recipe";
import connectDB from "@/lib/mongoose";

export async function POST(request: NextRequest) {
  try {
    await connectDB();

    const { title, description } = await request.json();
    await Recipe.create({ title, description });

    return NextResponse.json(
      {
        message: "Recipe created",
      },
      {
        status: 201,
      },
    );
  } catch (error) {
    console.error(`Error during POST Recip request : ${error}`);
    return NextResponse.json(
      {
        message: "Serveur was unable to create the recipe.",
        error: error,
      },
      {
        status: 500,
      },
    );
  }
}

export async function GET() {
  await connectDB();
  const recipes = await Recipe.find();
  return NextResponse.json({ recipes });
}
